<?php
require_once __DIR__ . '/helpers/auth_helper.php';
requireLogin();
require_once __DIR__ . '/config/db.php';
$pageTitle = 'Dashboard';
$summary = [
    'total' => 0,
    'low_stock' => 0,
    'expiring' => 0,
];
$lowStockMedicines = [];
$expiringMedicines = [];
try {
    $countTotal = $pdo->query('SELECT COUNT(*) AS total FROM medicines');
    $summary['total'] = (int)$countTotal->fetchColumn();
    $countLow = $pdo->query('SELECT COUNT(*) FROM medicines WHERE quantity < reorder_level');
    $summary['low_stock'] = (int)$countLow->fetchColumn();
    $countExpiring = $pdo->query('SELECT COUNT(*) FROM medicines WHERE expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)');
    $summary['expiring'] = (int)$countExpiring->fetchColumn();
    $lowStmt = $pdo->query('SELECT id, name, quantity, reorder_level FROM medicines WHERE quantity < reorder_level ORDER BY quantity ASC LIMIT 10');
    $lowStockMedicines = $lowStmt->fetchAll();
    $expStmt = $pdo->query('SELECT id, name, expiry_date, DATEDIFF(expiry_date, CURDATE()) AS days_left FROM medicines WHERE expiry_date IS NOT NULL AND expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY) ORDER BY expiry_date ASC LIMIT 10');
    $expiringMedicines = $expStmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to load dashboard data.'];
}
include __DIR__ . '/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<?php if ($flash): ?>
    <div class="alert alert-<?= sanitize($flash['type'] ?? 'info') ?>">
        <?= sanitize($flash['message'] ?? '') ?>
    </div>
<?php endif; ?>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary h-100">
            <div class="card-body">
                <h2 class="card-title h5">Total Medicines</h2>
                <p class="display-6 mb-0"><?= sanitize((string)$summary['total']) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning h-100">
            <div class="card-body">
                <h2 class="card-title h5">Low Stock</h2>
                <p class="display-6 mb-0"><?= sanitize((string)$summary['low_stock']) ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-danger h-100">
            <div class="card-body">
                <h2 class="card-title h5">Expiring Soon</h2>
                <p class="display-6 mb-0"><?= sanitize((string)$summary['expiring']) ?></p>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-transparent">
                <h2 class="h5 mb-0">Low Stock Medicines</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col" class="text-end">Quantity</th>
                            <th scope="col" class="text-end">Reorder Level</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($lowStockMedicines): ?>
                            <?php foreach ($lowStockMedicines as $medicine): ?>
                                <tr>
                                    <td><?= sanitize($medicine['name']) ?></td>
                                    <td class="text-end"><?= sanitize((string)$medicine['quantity']) ?></td>
                                    <td class="text-end"><?= sanitize((string)$medicine['reorder_level']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center p-4">No low stock medicines.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header bg-transparent">
                <h2 class="h5 mb-0">Expiring Soon</h2>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col" class="text-end">Days Left</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($expiringMedicines): ?>
                            <?php foreach ($expiringMedicines as $medicine): ?>
                                <tr>
                                    <td><?= sanitize($medicine['name']) ?></td>
                                    <td><?= sanitize($medicine['expiry_date']) ?></td>
                                    <td class="text-end"><?= sanitize((string)($medicine['days_left'] ?? '')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center p-4">No medicines expiring soon.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
