<?php
session_start();
date_default_timezone_set('America/Caracas');

const APP_NAME = 'Inventario Institucional';
const DB_HOST = '10.0.3.177';
const DB_PORT = '5432';
const DB_NAME = 'inventario';
const DB_USER = 'humner';
const DB_PASS = 'Uts1234.';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$baseDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
$baseUrl = ($baseDir === '' || $baseDir === '/') ? '/' : $baseDir . '/';

define('BASE_URL', $baseUrl);

function url(string $path = ''): string
{
    $base = rtrim(BASE_URL, '/');
    $cleanPath = ltrim($path, '/');

    if ($base !== '' && $base !== '/' && preg_match('#^inventario(/|$)#i', $cleanPath)) {
        $cleanPath = preg_replace('#^inventario/?#i', '', $cleanPath);
    }

    if ($cleanPath === '') {
        return $base === '' ? '/' : $base . '/';
    }

    return $base === '' ? '/' . $cleanPath : $base . '/' . $cleanPath;
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}
