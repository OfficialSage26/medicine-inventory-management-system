<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Categories';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
try {
    $stmt = $pdo->query('SELECT id, name, created_at, updated_at FROM categories ORDER BY name ASC');
    $categories = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $categories = [];
    $flash = ['type' => 'danger', 'message' => 'Failed to load categories.'];
}
include __DIR__ . '/../header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 mb-1">Categories</h1>
        <p class="text-muted mb-0">Manage medicine categories.</p>
    </div>
    <a href="add.php" class="btn btn-primary">Add Category</a>
</div>
<?php if ($flash): ?>
    <div class="alert alert-<?= sanitize($flash['type'] ?? 'info') ?>">
        <?= sanitize($flash['message'] ?? '') ?>
    </div>
<?php endif; ?>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($categories): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= sanitize((string)$category['id']) ?></td>
                            <td><?= sanitize($category['name']) ?></td>
                            <td><?= sanitize($category['created_at']) ?></td>
                            <td><?= sanitize($category['updated_at']) ?></td>
                            <td class="text-end">
                                <a href="edit.php?id=<?= sanitize((string)$category['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="delete.php" method="post" class="d-inline" onsubmit="return confirm('Delete this category? Medicines will lose the category association.');">
                                    <input type="hidden" name="csrf_token" value="<?= sanitize(csrf_token()) ?>">
                                    <input type="hidden" name="id" value="<?= sanitize((string)$category['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center p-4">No categories found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
