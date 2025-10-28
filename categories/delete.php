<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('categories/index.php');
}
if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Invalid request. Please try again.'];
    redirect('categories/index.php');
}
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
try {
    $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category deleted.'];
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to delete category.'];
}
redirect('/categories/index.php');
