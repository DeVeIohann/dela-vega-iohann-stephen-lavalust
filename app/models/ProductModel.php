<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model {

    public function ensure_table() {
        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }

        $driver = strtolower(database_config()['default']['driver'] ?? database_config()['main']['driver'] ?? 'sqlite');

        if ($driver === 'mysql') {
            try {
                $columns = lava_instance()->db->raw("SHOW COLUMNS FROM products");
                $column_names = [];

                foreach ($columns as $column) {
                    $column_names[] = strtolower($column['Field']);
                }

                if (!in_array('product_name', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE products ADD COLUMN product_name VARCHAR(255) NOT NULL DEFAULT ''");
                }

                if (!in_array('description', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE products ADD COLUMN description TEXT NULL");
                }

                if (!in_array('price', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE products ADD COLUMN price DECIMAL(10,2) NOT NULL DEFAULT 0.00");
                }

                if (!in_array('quantity', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE products ADD COLUMN quantity INT NOT NULL DEFAULT 0");
                }

                if (!in_array('created_at', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE products ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
                }

                return;
            } catch (Exception $e) {
                $sql = "CREATE TABLE IF NOT EXISTS products (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(255) NOT NULL,
                    description TEXT NOT NULL,
                    price DECIMAL(10,2) NOT NULL,
                    quantity INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                lava_instance()->db->raw($sql);
                return;
            }
        }

        try {
            lava_instance()->db->raw("SELECT 1 FROM products LIMIT 1");
        } catch (Exception $e) {
            if ($driver === 'mysql') {
                $sql = "CREATE TABLE IF NOT EXISTS products (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(255) NOT NULL,
                    description TEXT NOT NULL,
                    price DECIMAL(10,2) NOT NULL,
                    quantity INT NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            } else {
                $sql = "CREATE TABLE IF NOT EXISTS products (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    product_name TEXT NOT NULL,
                    description TEXT NOT NULL,
                    price REAL NOT NULL,
                    quantity INTEGER NOT NULL,
                    created_at TEXT DEFAULT CURRENT_TIMESTAMP
                )";
            }
            lava_instance()->db->raw($sql);
        }
    }

    public function get_all_products() {
        $this->ensure_table();
        return $this->db->table('products')->get_all();
    }

    public function get_product_by_id($id) {
        $this->ensure_table();
        return $this->db->table('products')->where('id', $id)->get();
    }

    public function insert_product($data) {
        $this->ensure_table();
        return $this->db->table('products')->insert($data);
    }

    public function update_product($id, $data) {
        $this->ensure_table();
        return $this->db->table('products')->where('id', $id)->update($data);
    }

    public function delete_product($id) {
        $this->ensure_table();
        return $this->db->table('products')->where('id', $id)->delete();
    }
}