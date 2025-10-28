<?php
require_once __DIR__ . '/helpers/auth_helper.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['username'] ?? 'User';
$pageTitle = $pageTitle ?? 'Medicine Inventory System';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= sanitize($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= sanitize(app_url('public/assets/css/app.css')) ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold" href="<?= sanitize(app_url('dashboard.php')) ?>">Medicine Inventory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php $currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/'); ?>
                <li class="nav-item"><a class="nav-link <?= str_contains($currentPath, 'dashboard') ? 'active' : '' ?>" href="<?= sanitize(app_url('dashboard.php')) ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= str_contains($currentPath, 'medicines') ? 'active' : '' ?>" href="<?= sanitize(app_url('medicines/index.php')) ?>">Medicines</a></li>
                <li class="nav-item"><a class="nav-link <?= str_contains($currentPath, 'categories') ? 'active' : '' ?>" href="<?= sanitize(app_url('categories/index.php')) ?>">Categories</a></li>
            </ul>
            <span class="navbar-text me-3 text-light">Signed in as <?= sanitize($username) ?></span>
            <a class="btn btn-light text-primary" href="<?= sanitize(app_url('auth/logout.php')) ?>">Logout</a>
        </div>
    </div>
</nav>
<main class="container py-4">
