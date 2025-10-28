<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function load_env(): void
{
    static $loaded = false;
    if ($loaded) {
        return;
    }
    $envFile = __DIR__ . '/../.env';
    if (file_exists($envFile) && is_readable($envFile)) {
        foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            [$key, $value] = array_pad(explode('=', $line, 2), 2, null);
            if ($key !== null && $value !== null) {
                $key = trim($key);
                $value = trim($value);
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
                putenv($key . '=' . $value);
            }
        }
    }
    $loaded = true;
}
function app_base_url(): string
{
    static $base;
    if ($base !== null) {
        return $base;
    }
    load_env();
    $base = $_ENV['APP_BASE_URL'] ?? $_SERVER['APP_BASE_URL'] ?? getenv('APP_BASE_URL') ?: '';
    if ($base === '') {
        $projectDir = realpath(__DIR__ . '/..');
        $documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $documentRootReal = $documentRoot !== '' ? realpath($documentRoot) : false;
        if ($projectDir && $documentRootReal && str_starts_with($projectDir, $documentRootReal)) {
            $relativePath = str_replace('\\', '/', substr($projectDir, strlen($documentRootReal)));
            $relativePath = '/' . ltrim($relativePath, '/');
            if (!empty($_SERVER['HTTP_HOST'])) {
                $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                $base = $scheme . '://' . $_SERVER['HTTP_HOST'] . $relativePath;
            } else {
                $base = $relativePath;
            }
        }
    }
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
