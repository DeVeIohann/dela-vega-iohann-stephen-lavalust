<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {

    public function __construct() {
        parent::__construct();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $data = [
            'page_title' => 'Portal Hub | Student Information System'
        ];

        $this->call->view('student_index', $data);
    }

    public function profile() {
        require_once APP_DIR . 'middlewares/StudentMiddleware.php';
        $middleware = new StudentMiddleware();
        $middleware->handle();

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
            'profile_description' => 'Dedicated Information Technology student specializing in network architecture, database optimizations, and low-level system design. Experienced in developing custom full-stack solutions and routing protocols.',
            'skills'              => ['PHP / LavaLust', 'C#', 'SQL', 'Cisco Networking', 'x86 Assembly'],
            'hobbies'             => ['Reading Light Novels & Manhua', 'Shooter/Moba Games', 'Fishing', 'Swimming']
        ];

        $this->call->view('student_profile', $data);
    }

    public function login() {
        $_SESSION['student_logged_in'] = true;
        unset($_SESSION['auth_error']);
        header('Location: http://localhost/LALA/LavaLust/student/profile');
        exit();
    }

    public function logout() {
        unset($_SESSION['student_logged_in']);
        unset($_SESSION['auth_error']);
        session_destroy();

        header('Location: http://localhost/LALA/LavaLust/student');
        exit();
    }
}