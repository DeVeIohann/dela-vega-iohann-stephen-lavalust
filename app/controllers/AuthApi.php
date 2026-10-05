<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthApi extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('User_model');
        
        // Handle Preflight CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        header("Access-Control-Allow-Methods: POST, OPTIONS");
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    public function login() {
        $rawInput = json_decode(file_get_contents('php://input'), true);
        $username = $rawInput['username'] ?? '';
        $password = $rawInput['password'] ?? '';

        if (empty($username) || empty($password)) {
            return $this->api->respond([
                'status' => 'error',
                'message' => 'Username and password are required'
            ], 400);
        }

        $user = $this->User_model->get_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            // Generate simple bearer token / session key
            $token = bin2hex(random_bytes(32));
            $this->User_model->update_token($user['id'], $token);

            return $this->api->respond([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'token' => $token,
                    'username' => $user['username']
                ]
            ], 200);
        }

        return $this->api->respond([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ], 401);
    }
}