<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
require_once APP_DIR . 'controllers/Api_controller.php';

class Auth extends Api_controller
{
    public function login()
    {
        $this->api->require_method('POST');
        $body = $this->api->body();
        $username = $body['username'] ?? null;
        $password = $body['password'] ?? null;

        if (!is_string($username) || !is_string($password) || trim($username) === '' || $password === '') {
            $this->api->respond_error('Username and password are required.', 422);
        }

        $statement = $this->db->raw(
            'SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1',
            [trim($username)]
        );
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->api->respond_error('Invalid username or password.', 401);
        }

        $now = time();
        $token = $this->api->encode_jwt([
            'sub' => (int) $user['id'],
            'username' => $user['username'],
            'iat' => $now,
            'exp' => $now + 3600,
        ]);

        $this->api->respond([
            'token' => $token,
            'user' => [
                'id' => (int) $user['id'],
                'username' => $user['username'],
            ],
            'expires_in' => 3600,
        ]);
    }

    public function me()
    {
        $user = $this->authenticated_user();
        $this->api->respond([
            'user' => [
                'id' => (int) $user['sub'],
                'username' => $user['username'] ?? '',
            ],
        ]);
    }

    public function logout()
    {
        $this->authenticated_user();
        $this->api->respond(['message' => 'Signed out. Discard the access token on this client.']);
    }
}
