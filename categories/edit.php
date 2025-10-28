<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Edit Category';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];
try {
    $stmt = $pdo->prepare('SELECT id, name FROM categories WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $category = $stmt->fetch();
    if (!$category) {
        $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Category not found.'];
        redirect('/categories/index.php');
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to load category.'];
    redirect('/categories/index.php');
}
$name = $category['name'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Invalid request. Please try again.';
    }
    $name = trim($_POST['name'] ?? '');
    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (mb_strlen($name) > 100) {
        $errors[] = 'Name must be 100 characters or fewer.';
    }
    if (!$errors) {
        try {
            $stmt = $pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
            $stmt->execute([':name' => $name, ':id' => $id]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category updated.'];
            redirect('/categories/index.php');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            if ($e->getCode() === '23000') {
                $errors[] = 'Category name must be unique.';
            } else {
                $errors[] = 'Failed to update category. Please try again later.';
            }
        }
    }
}
include __DIR__ . '/../header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="h3 mb-3">Edit Category</h1>
        <?php if ($errors): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= sanitize($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="post" novalidate>
            <input type="hidden" name="csrf_token" value="<?= sanitize(csrf_token()) ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required maxlength="100" value="<?= sanitize($name) ?>">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/categories/index.php" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
