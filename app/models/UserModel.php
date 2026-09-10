<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'users';

        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }
    }

    public function ensure_table() {
        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }

        $driver = strtolower(database_config()['default']['driver'] ?? database_config()['main']['driver'] ?? 'sqlite');

        if ($driver === 'mysql') {
            try {
                $columns = lava_instance()->db->raw("SHOW COLUMNS FROM users");
                $column_names = [];

                foreach ($columns as $column) {
                    $column_names[] = strtolower($column['Field']);
                }

                if (!in_array('username', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE users ADD COLUMN username VARCHAR(255) NOT NULL UNIQUE AFTER id");
                }

                if (!in_array('email', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE users ADD COLUMN email VARCHAR(255) NOT NULL DEFAULT '' AFTER username");
                }

                if (!in_array('password_hash', $column_names, true)) {
                    if (in_array('password', $column_names, true)) {
                        lava_instance()->db->raw("ALTER TABLE users CHANGE password password_hash VARCHAR(255) NOT NULL");
                    } else {
                        lava_instance()->db->raw("ALTER TABLE users ADD COLUMN password_hash VARCHAR(255) NOT NULL AFTER email");
                    }
                }

                if (!in_array('created_at', $column_names, true)) {
                    lava_instance()->db->raw("ALTER TABLE users ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
                }

                try {
                    lava_instance()->db->raw("ALTER TABLE users ADD UNIQUE INDEX unique_email (email)");
                } catch (Exception $ignored) {
                }

                return;
            } catch (Exception $e) {
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) NOT NULL UNIQUE,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password_hash VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                lava_instance()->db->raw($sql);
                return;
            }
        }

        try {
            lava_instance()->db->raw("SELECT 1 FROM users LIMIT 1");
        } catch (Exception $e) {
            if ($driver === 'mysql') {
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) NOT NULL UNIQUE,
                    email VARCHAR(255) NOT NULL UNIQUE,
                    password_hash VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            } else {
                $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    username TEXT NOT NULL UNIQUE,
                    email TEXT NOT NULL UNIQUE,
                    password_hash TEXT NOT NULL,
                    created_at TEXT DEFAULT CURRENT_TIMESTAMP
                )";
            }
            lava_instance()->db->raw($sql);
        }
    }

    public function create_user($data) {
        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }
        return lava_instance()->db->table('users')->insert($data);
    }

    public function find_by_username($username) {
        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }
        $result = lava_instance()->db->table('users')->where('username', $username)->get();
        return is_array($result) ? $result : null;
    }

    public function find_by_email($email) {
        if (!isset(lava_instance()->db)) {
            lava_instance()->call->database();
        }
        $result = lava_instance()->db->table('users')->where('email', $email)->get();
        return is_array($result) ? $result : null;
    }
}
