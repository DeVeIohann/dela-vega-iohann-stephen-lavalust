<?php
class StudentMiddleware {

    public function handle() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // TF2 Mercenary Access Verification
        if (!isset($_SESSION['student_logged_in']) || $_SESSION['student_logged_in'] !== true) {
            $_SESSION['auth_error'] = "INTRUDER ALERT! A SPY IS IN THE BASE! You must authenticate before accessing classified dossier files.";
            header('Location: http://localhost/LALA/LavaLust/student');
            exit();
        }
    }
}