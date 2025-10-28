<?php
require_once __DIR__ . '/../helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/../config/db.php';
$pageTitle = 'Add Medicine';
$name = '';
$categoryId = '';
$quantity = '';
$reorderLevel = 10;
$expiryDate = '';
$errors = [];
try {
    $catStmt = $pdo->query('SELECT id, name FROM categories ORDER BY name');
    $categories = $catStmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $categories = [];
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to load categories.'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Invalid request. Please try again.';
    }
    $name = trim($_POST['name'] ?? '');
    $categoryId = $_POST['category_id'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $reorderLevel = $_POST['reorder_level'] ?? 10;
    $expiryDate = trim($_POST['expiry_date'] ?? '');
    if ($name === '') {
        $errors[] = 'Name is required.';
    } elseif (mb_strlen($name) > 150) {
        $errors[] = 'Name must be 150 characters or fewer.';
    }
    if ($quantity === '' || filter_var($quantity, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errors[] = 'Quantity must be a non-negative integer.';
    }
    if ($reorderLevel === '' || filter_var($reorderLevel, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false) {
        $errors[] = 'Reorder level must be a non-negative integer.';
    }
    if ($expiryDate !== '') {
        $d = DateTime::createFromFormat('Y-m-d', $expiryDate);
        if (!$d || $d->format('Y-m-d') !== $expiryDate) {
            $errors[] = 'Expiry date must be in YYYY-MM-DD format.';
        }
    } else {
        $expiryDate = null;
    }
    if (!$errors) {
        try {
            $stmt = $pdo->prepare('INSERT INTO medicines (name, category_id, quantity, reorder_level, expiry_date) VALUES (:name, :category_id, :quantity, :reorder_level, :expiry_date)');
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            if ($categoryId === '' || (int)$categoryId === 0) {
                $stmt->bindValue(':category_id', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':category_id', (int)$categoryId, PDO::PARAM_INT);
            }
            $stmt->bindValue(':quantity', (int)$quantity, PDO::PARAM_INT);
            $stmt->bindValue(':reorder_level', (int)$reorderLevel, PDO::PARAM_INT);
            if ($expiryDate === null) {
                $stmt->bindValue(':expiry_date', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':expiry_date', $expiryDate, PDO::PARAM_STR);
            }
            $stmt->execute();
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Medicine created.'];
            redirect('/medicines/index.php');
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $errors[] = 'Failed to create medicine. Please try again later.';
        }
    }
}
include __DIR__ . '/../header.php';
?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <h1 class="h3 mb-3">Add Medicine</h1>
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
                <input type="text" class="form-control" id="name" name="name" required maxlength="150" value="<?= sanitize($name) ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">None</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= sanitize((string)$category['id']) ?>" <?= (int)$categoryId === (int)$category['id'] ? 'selected' : '' ?>><?= sanitize($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="0" required value="<?= sanitize((string)$quantity) ?>">
                </div>
                <div class="col-md-4">
                    <label for="reorder_level" class="form-label">Reorder Level</label>
                    <input type="number" class="form-control" id="reorder_level" name="reorder_level" min="0" required value="<?= sanitize((string)$reorderLevel) ?>">
                </div>
                <div class="col-md-4">
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="<?= sanitize($expiryDate ?? '') ?>">
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="/medicines/index.php" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
