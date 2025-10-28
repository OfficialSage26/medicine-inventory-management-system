<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Medicines';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$search = trim($_GET['q'] ?? '');
$categoryFilter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;
$conditions = [];
$params = [];
if ($search !== '') {
    $conditions[] = 'm.name LIKE :search';
    $params[':search'] = '%' . $search . '%';
}
if ($categoryFilter > 0) {
    $conditions[] = 'm.category_id = :category';
    $params[':category'] = $categoryFilter;
}
$where = '';
if ($conditions) {
    $where = 'WHERE ' . implode(' AND ', $conditions);
}
try {
    $countSql = "SELECT COUNT(*) FROM medicines m {$where}";
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        $paramType = $key === ':category' ? PDO::PARAM_INT : PDO::PARAM_STR;
        $countStmt->bindValue($key, $value, $paramType);
    }
    $countStmt->execute();
    $total = (int)$countStmt->fetchColumn();
    $totalPages = max(1, (int)ceil($total / $perPage));
    if ($page > $totalPages) {
        $page = $totalPages;
        $offset = ($page - 1) * $perPage;
    }
    $sql = "SELECT m.*, c.name AS category_name FROM medicines m LEFT JOIN categories c ON c.id = m.category_id {$where} ORDER BY m.name ASC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $value) {
        $paramType = $key === ':category' ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($key, $value, $paramType);
    }
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $medicines = $stmt->fetchAll();
    $catStmt = $pdo->query('SELECT id, name FROM categories ORDER BY name');
    $categories = $catStmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $medicines = [];
    $categories = [];
    $total = 0;
    $totalPages = 1;
    $flash = ['type' => 'danger', 'message' => 'Failed to load medicines.'];
}
include __DIR__ . '/../header.php';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h1 class="h3 mb-1">Medicines</h1>
        <p class="text-muted mb-0">Manage medicine records, search, and filter.</p>
    </div>
    <a href="add.php" class="btn btn-primary">Add Medicine</a>
</div>
<?php if ($flash): ?>
    <div class="alert alert-<?= sanitize($flash['type'] ?? 'info') ?>">
        <?= sanitize($flash['message'] ?? '') ?>
    </div>
<?php endif; ?>
<div class="card mb-3">
    <div class="card-body">
        <form class="row g-3" method="get">
            <div class="col-md-5">
                <label for="q" class="form-label">Search by name</label>
                <input type="text" class="form-control" id="q" name="q" value="<?= sanitize($search) ?>" placeholder="Enter medicine name">
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select">
                    <option value="0">All categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= sanitize((string)$category['id']) ?>" <?= $categoryFilter === (int)$category['id'] ? 'selected' : '' ?>><?= sanitize($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                    <a href="<?= sanitize(app_url('medicines/index.php')) ?>" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Reorder Level</th>
                    <th scope="col">Expiry Date</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($medicines): ?>
                    <?php foreach ($medicines as $medicine): ?>
                        <tr>
                            <td><?= sanitize((string)$medicine['id']) ?></td>
                            <td><?= sanitize($medicine['name']) ?></td>
                            <td><?= sanitize($medicine['category_name'] ?? 'Unassigned') ?></td>
                            <td><?= sanitize((string)$medicine['quantity']) ?></td>
                            <td><?= sanitize((string)$medicine['reorder_level']) ?></td>
                            <td><?= sanitize($medicine['expiry_date'] ?? 'N/A') ?></td>
                            <td class="text-end">
                                <a href="edit.php?id=<?= sanitize((string)$medicine['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="delete.php" method="post" class="d-inline" onsubmit="return confirm('Delete this medicine?');">
                                    <input type="hidden" name="csrf_token" value="<?= sanitize(csrf_token()) ?>">
                                    <input type="hidden" name="id" value="<?= sanitize((string)$medicine['id']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center p-4">No medicines found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if ($totalPages > 1): ?>
    <nav class="mt-3" aria-label="Medicines pagination">
        <ul class="pagination">
            <?php $queryBase = $_GET; ?>
            <?php $queryBase['page'] = max(1, $page - 1); ?>
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= http_build_query($queryBase) ?>" aria-label="Previous">&laquo;</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php $queryBase['page'] = $i; ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>"><a class="page-link" href="?<?= http_build_query($queryBase) ?>"><?= $i ?></a></li>
            <?php endfor; ?>
            <?php $queryBase['page'] = min($totalPages, $page + 1); ?>
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= http_build_query($queryBase) ?>" aria-label="Next">&raquo;</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>
