<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
require_once APP_DIR . 'controllers/Api_controller.php';

class Products extends Api_controller
{
    public function index()
    {
        $this->authenticated_user();
        $statement = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products ORDER BY created_at DESC, id DESC'
        );
        $this->api->respond(['products' => $statement->fetchAll(PDO::FETCH_ASSOC)]);
    }

    public function create()
    {
        $this->authenticated_user();
        $this->api->require_method('POST');
        $product = $this->validate_product($this->api->body(), [], true);

        $this->db->raw(
            'INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)',
            array_values($product)
        );
        $id = (int) $this->db->raw('SELECT LAST_INSERT_ID()')->fetchColumn();
        $created = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products WHERE id = ?',
            [$id]
        )->fetch(PDO::FETCH_ASSOC);

        $this->api->respond(['product' => $created], 201);
    }

    public function update($id)
    {
        $this->authenticated_user();
        $this->api->require_method($_SERVER['REQUEST_METHOD']);
        $id = $this->product_id($id);
        $statement = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products WHERE id = ? LIMIT 1',
            [$id]
        );
        $current = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$current) {
            $this->api->respond_error('Product not found.', 404);
        }

        $replace = $_SERVER['REQUEST_METHOD'] === 'PUT';
        $product = $this->validate_product($this->api->body(), $current, $replace);
        $this->db->raw(
            'UPDATE products SET product_name = ?, description = ?, price = ?, quantity = ? WHERE id = ?',
            array_merge(array_values($product), [$id])
        );
        $updated = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products WHERE id = ?',
            [$id]
        )->fetch(PDO::FETCH_ASSOC);

        $this->api->respond(['product' => $updated]);
    }

    public function delete($id)
    {
        $this->authenticated_user();
        $this->api->require_method('DELETE');
        $id = $this->product_id($id);
        $statement = $this->db->raw('DELETE FROM products WHERE id = ?', [$id]);
        if ($statement->rowCount() === 0) {
            $this->api->respond_error('Product not found.', 404);
        }

        $this->api->respond(['message' => 'Product deleted.']);
    }
}
