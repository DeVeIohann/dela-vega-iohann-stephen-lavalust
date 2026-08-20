<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->call->library('session');
        $this->call->helper('url'); // Loads site_url() helper
    }

    public function index() {
        $data['page_title'] = "Mann Co. Academic Terminal";
        $this->call->view('student_index', $data);
    }

    public function profile() {
        // Enforce route middleware
        $this->call->middleware('StudentMiddleware');

        $data = [
            'page_title'          => 'My Student Profile - Digital Dashboard',
            'student_id'          => 'MCC2023-00861',
            'name'                => 'Iohann Stephen Dela Vega',
            'course'              => 'BS Information Technologies',
            'year'                => '3rd Year',
            'section'             => 'BSIT-3F4',
            'email'               => 'delavegaiohann0@gmail.com',
            'address'             => 'Masipit, Calapan City, Oriental Mindoro',
            'contact_number'      => '+63 967 943 4592',
            'profile_description' => 'Dedicated Information Technology student specializing in network architecture, database optimizations, and low-level system design.',
            'skills'              => ['PHP / LavaLust', 'C#', 'SQL', 'Cisco Networking', 'x86 Assembly'],
            'hobbies'             => ['Reading Light Novels & Manhua', 'Shooter/Moba Games', 'Fishing', 'Swimming']
        ];

        $this->call->view('student_profile', $data);
    }

    public function login() {
        $_SESSION['student_logged_in'] = true;
        header('Location: ' . site_url('student/profile'));
        exit();
    }

    public function logout() {
        unset($_SESSION['student_logged_in']);
        session_destroy();
        header('Location: ' . site_url('student'));
        exit();
    }
}