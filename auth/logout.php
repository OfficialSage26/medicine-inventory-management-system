<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
redirect('auth/login.php');
