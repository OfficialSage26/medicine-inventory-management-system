<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Add Category';
$name = '';
$errors = [];
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
            $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
            $stmt->execute([':name' => $name]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category created.'];
            redirect('/categories/index.php');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            if ($e->getCode() === '23000') {
                $errors[] = 'Category name must be unique.';
            } else {
                $errors[] = 'Failed to create category. Please try again later.';
            }
        }
    }
}
include __DIR__ . '/../header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-5">
        <div class="card form-card">
            <div class="card-header d-flex align-items-center">
                <span class="me-3 text-primary"><i class="bi bi-folder-plus fs-3"></i></span>
                <div>
                    <h1 class="h4 mb-0">Add Category</h1>
                    <p class="text-muted small mb-0">Create a new grouping for medicines.</p>
                </div>
            </div>
            <div class="card-body">
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
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                        <a href="<?= sanitize(app_url('categories/index.php')) ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
