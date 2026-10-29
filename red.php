<?php

if (!isset($_GET['url']) || $_GET['url'] === '') {
    $_GET['url'] = 'dispositivos/index';
}

require __DIR__ . '/index.php';
