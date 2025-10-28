<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('/medicines/index.php');
}
if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Invalid request. Please try again.'];
    redirect('/medicines/index.php');
}
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
try {
    $stmt = $pdo->prepare('DELETE FROM medicines WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => 'Medicine deleted.'];
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to delete medicine.'];
}
redirect('/medicines/index.php');
