<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductApi extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('Product_model');
        $this->call->model('User_model');

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    private function authenticate() {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
        $token = str_replace('Bearer ', '', $authHeader);

        if (!$this->User_model->verify_token($token)) {
            $this->api->respond([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ], 401);
            exit();
        }
    }

    // GET: Display all products
    public function index() {
        $products = $this->Product_model->get_all();
        return $this->api->respond([
            'status' => 'success',
            'data' => $products
        ], 200);
    }

    // POST: Add new product
    public function create() {
        $this->authenticate();
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['product_name']) || !isset($data['price']) || !isset($data['quantity'])) {
            return $this->api->respond(['status' => 'error', 'message' => 'Missing required fields'], 400);
        }

        $payload = [
            'product_name' => $data['product_name'],
            'description'  => $data['description'] ?? '',
            'price'        => $data['price'],
            'quantity'     => $data['quantity']
        ];

        if ($this->Product_model->insert($payload)) {
            return $this->api->respond(['status' => 'success', 'message' => 'Product created successfully'], 201);
        }

        return $this->api->respond(['status' => 'error', 'message' => 'Failed to create product'], 500);
    }

    // PUT: Update existing product
    public function update($id) {
        $this->authenticate();
        $data = json_decode(file_get_contents('php://input'), true);

        $payload = [
            'product_name' => $data['product_name'],
            'description'  => $data['description'] ?? '',
            'price'        => $data['price'],
            'quantity'     => $data['quantity']
        ];

        if ($this->Product_model->update($id, $payload)) {
            return $this->api->respond(['status' => 'success', 'message' => 'Product updated successfully'], 200);
        }

        return $this->api->respond(['status' => 'error', 'message' => 'Failed to update product'], 500);
    }

    // DELETE: Delete product
    public function delete($id) {
        $this->authenticate();

        if ($this->Product_model->delete($id)) {
            return $this->api->respond(['status' => 'success', 'message' => 'Product deleted successfully'], 200);
        }

        return $this->api->respond(['status' => 'error', 'message' => 'Failed to delete product'], 500);
    }
}