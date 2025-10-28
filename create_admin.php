<?php
if (php_sapi_name() !== 'cli') {
    echo "This script must be run from the command line.\n";
    exit(1);
}
require_once __DIR__ . '/config/db.php';
function prompt(string $message): string
{
    if (function_exists('readline')) {
        $response = readline($message);
    } else {
        echo $message;
        $response = fgets(STDIN);
    }
    return trim((string)$response);
}
$username = '';
while ($username === '') {
    $username = prompt('Enter admin username: ');
    if ($username === '') {
        echo "Username cannot be empty.\n";
    }
}
$password = '';
while ($password === '') {
    $password = prompt('Enter admin password (will be visible as you type): ');
    if ($password === '') {
        echo "Password cannot be empty.\n";
    }
}
try {
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([':username' => $username]);
    if ($stmt->fetch()) {
        echo "User '{$username}' already exists. Choose a different username.\n";
        exit(0);
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $insert = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
    $insert->execute([
        ':username' => $username,
        ':password' => $hash,
    ]);
    echo "Admin user '{$username}' created successfully.\n";
    echo "Reminder: delete create_admin.php after use for security.\n";
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo "Failed to create admin user. Check logs for details.\n";
    exit(1);
}
