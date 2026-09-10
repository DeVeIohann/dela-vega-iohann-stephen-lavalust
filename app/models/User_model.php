<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class User_model extends Model {
    
    public function get_user_by_username($username) {
        return $this->db->table('users')->where('username', $username)->get();
    }

    public function register($username, $password) {
        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];
        return $this->db->table('users')->insert($data);
    }
}