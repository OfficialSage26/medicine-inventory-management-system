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
        <div class="card stat-card bg-gradient-primary h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 text-white-50">Total Medicines</p>
                    <h2 class="display-6 mb-0 text-white"><?= sanitize((string)$summary['total']) ?></h2>
                </div>
                <div class="icon-circle text-white">
                    <i class="bi bi-capsule"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-warning h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 text-dark-50">Low Stock</p>
                    <h2 class="display-6 mb-0 text-dark"><?= sanitize((string)$summary['low_stock']) ?></h2>
                </div>
                <div class="icon-circle text-dark">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card bg-danger h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase small mb-1 text-white-50">Expiring Soon</p>
                    <h2 class="display-6 mb-0 text-white"><?= sanitize((string)$summary['expiring']) ?></h2>
                </div>
                <div class="icon-circle text-white">
                    <i class="bi bi-calendar-x"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card h-100 shadow-soft">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">Low Stock Medicines</h2>
                <span class="badge bg-danger-subtle text-danger">Threshold &lt; reorder level</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
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
                                    <td class="text-end"><span class="badge bg-danger-subtle text-danger"><?= sanitize((string)$medicine['quantity']) ?></span></td>
                                    <td class="text-end"><?= sanitize((string)$medicine['reorder_level']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center p-4 text-muted">No low stock medicines.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100 shadow-soft">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">Expiring Soon</h2>
                <span class="badge bg-warning-subtle text-warning">Within 30 days</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
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
                                    <td><span class="badge bg-warning-subtle text-warning"><?= sanitize($medicine['expiry_date']) ?></span></td>
                                    <td class="text-end"><?= sanitize((string)($medicine['days_left'] ?? '')) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center p-4 text-muted">No medicines expiring soon.</td>
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
