<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {

    public function index() {
        $this->login();
    }

    public function login() {
        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($username === 'admin' && $password === 'admin123') {
                $this->session->set_userdata('logged_in', true);
                redirect('products');
            } else {
                $data['error'] = 'Invalid username or password';
                $this->call->view('auth/login', $data);
                return;
            }
        }
        $this->call->view('auth/login');
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('auth/login');
    }
}