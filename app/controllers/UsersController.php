<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {

    public function index() {
    try {
        $this->call->database();
        $this->call->model('UsersModel');
        $data['users'] = $this->UsersModel->get_all_users();
        $this->call->view('users_view', $data);
    } catch (Exception $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
}