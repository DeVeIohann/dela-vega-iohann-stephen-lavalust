<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->model('ProductModel');
        $this->call->library('session');

        // Block access to unauthenticated users
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            exit();
        }
    }

    public function index() {
        $data['products'] = $this->ProductModel->get_all_products();
        $this->call->view('products/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $data = [
                'product_name' => $this->io->post('product_name'),
                'description'  => $this->io->post('description'),
                'price'        => $this->io->post('price'),
                'quantity'     => $this->io->post('quantity')
            ];
            $this->ProductModel->insert_product($data);
            redirect('products');
        }
        $this->call->view('products/create');
    }

    public function edit($id) {
        if ($this->form_validation->submitted()) {
            $data = [
                'product_name' => $this->io->post('product_name'),
                'description'  => $this->io->post('description'),
                'price'        => $this->io->post('price'),
                'quantity'     => $this->io->post('quantity')
            ];
            $this->ProductModel->update_product($id, $data);
            redirect('products');
        }
        $data['product'] = $this->ProductModel->get_product_by_id($id);
        $this->call->view('products/edit', $data);
    }

    public function delete($id) {
        $this->ProductModel->delete_product($id);
        redirect('products');
    }
}