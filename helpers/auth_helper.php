<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function app_base_url(): string
{
    static $base;
    if ($base !== null) {
        return $base;
    }
    $base = $_ENV['APP_BASE_URL'] ?? $_SERVER['APP_BASE_URL'] ?? getenv('APP_BASE_URL') ?: '';
    $base = rtrim($base, '/');
    return $base;
}
function app_url(string $path = ''): string
{
    $base = app_base_url();
    $path = '/' . ltrim($path, '/');
    return $base . $path;
}
function redirect(string $url): void
{
    if (!preg_match('#^https?://#', $url)) {
        $url = app_url($url);
    }
    header('Location: ' . $url);
    exit;
}
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}
function requireLogin(): void
{
    if (!isLoggedIn()) {
        redirect('auth/login.php');
    }
}
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function verify_csrf_token(?string $token): bool
{
    return is_string($token) && hash_equals($_SESSION['csrf_token'] ?? '', $token);
}
function sanitize(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
