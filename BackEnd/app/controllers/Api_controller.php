<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Api_controller extends Controller
{
    protected $db;
    protected $api;

    public function __construct()
    {
        parent::__construct();

        $secret = getenv('JWT_SECRET');
        if (!is_string($secret) || strlen($secret) < 32) {
            http_response_code(500);
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(['error' => 'Server authentication is not configured. Set JWT_SECRET to at least 32 characters.']);
            exit;
        }

        $this->api = load_class('api', 'libraries');
        $this->db = load_class('database', 'database');
        lava_instance()->db = $this->db;
    }

    protected function authenticated_user()
    {
        return $this->api->require_jwt();
    }

    protected function validate_product(array $data, array $current = [], bool $replace = false)
    {
        $fields = ['product_name', 'description', 'price', 'quantity'];
        foreach (array_keys($data) as $field) {
            if (!in_array($field, $fields, true)) {
                $this->api->respond_error("Unknown product field: {$field}", 422);
            }
        }

        $product = $replace ? [] : $current;
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $product[$field] = $data[$field];
            } elseif ($replace && $field === 'description') {
                $product[$field] = '';
            } elseif ($replace) {
                $this->api->respond_error("The {$field} field is required.", 422);
            }
        }

        if (!isset($product['product_name']) || !is_string($product['product_name'])) {
            $this->api->respond_error('Product name is required.', 422);
        }
        $product['product_name'] = trim($product['product_name']);
        if ($product['product_name'] === '' || strlen($product['product_name']) > 100) {
            $this->api->respond_error('Product name must be between 1 and 100 characters.', 422);
        }

        if (!isset($product['description']) || !is_string($product['description'])) {
            $this->api->respond_error('Description must be text.', 422);
        }

        if (!isset($product['price']) || !is_numeric($product['price'])) {
            $this->api->respond_error('Price must be a non-negative number.', 422);
        }
        $price = (float) $product['price'];
        if (!is_finite($price) || $price < 0 || $price > 99999999.99) {
            $this->api->respond_error('Price must be between 0 and 99,999,999.99.', 422);
        }

        if (!isset($product['quantity']) || filter_var($product['quantity'], FILTER_VALIDATE_INT) === false) {
            $this->api->respond_error('Quantity must be a non-negative whole number.', 422);
        }
        $quantity = (int) $product['quantity'];
        if ($quantity < 0) {
            $this->api->respond_error('Quantity must be a non-negative whole number.', 422);
        }

        return [
            'product_name' => $product['product_name'],
            'description' => $product['description'],
            'price' => number_format($price, 2, '.', ''),
            'quantity' => $quantity,
        ];
    }

    protected function product_id($id)
    {
        if (!is_string($id) || !preg_match('/^[1-9][0-9]*$/D', $id)) {
            $this->api->respond_error('Invalid product ID.', 400);
        }
        return (int) $id;
    }
}
