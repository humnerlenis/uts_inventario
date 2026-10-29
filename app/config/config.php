<?php
session_start();
date_default_timezone_set('America/Caracas');

const APP_NAME = 'Inventario Institucional';
const DB_HOST = '10.0.3.177';
const DB_PORT = '5432';
const DB_NAME = 'inventario';
const DB_USER = 'humner';
const DB_PASS = 'Uts1234.';
const INVENTARIO_WEBHOOK_URL = 'https://defaultdd1173794b6942798e10f46280ce4f.8e.environment.api.powerplatform.com:443/powerautomate/automations/direct/cu/06/workflows/0b20d10d74544be29d93e4447a53de15/triggers/manual/paths/invoke?api-version=1&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=va7vfbC7adHxakMPoIIfzRWFo6j2Z6oSy7TN050X-gA';

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$baseDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
$baseUrl = ($baseDir === '' || $baseDir === '/') ? '/' : $baseDir . '/';

define('BASE_URL', $baseUrl);

function url(string $path = ''): string
{
    $base = rtrim(BASE_URL, '/');
    $cleanPath = ltrim($path, '/');

    if ($cleanPath === '') {
        return $base === '' ? '/' : $base . '/';
    }

    return $base === '' ? '/' . $cleanPath : $base . '/' . $cleanPath;
}

function redUrl(string $route = 'dispositivos/index'): string
{
    return url('red.php') . '?url=' . rawurlencode($route);
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}
