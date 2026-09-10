<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('User_model');
        $this->call->library('session');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('products');
        }
        $this->call->view('auth/login');
    }

    public function authenticate() {
        $username = $this->io->post('username');
        $password = $this->io->post('password');

        $user = $this->User_model->get_user_by_username($username);

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set_userdata([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'logged_in' => TRUE
            ]);
            redirect('products');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password.');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}