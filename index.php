<?php
require_once __DIR__ . '/helpers/auth_helper.php';
if (isLoggedIn()) {
    redirect('dashboard.php');
}
redirect('auth/login.php');
