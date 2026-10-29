<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? APP_NAME) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('assets/css/styles.css') ?>">
</head>
<body>
    <?php
    $module = $module ?? 'dispositivos';
    $moduleName = $module === 'dispositivos' ? 'Dispositivos' : 'Inventario';
    $moduleUrl = $module === 'dispositivos' ? redUrl('dispositivos/index') : url('inventario');
    $createUrl = $module === 'dispositivos' ? redUrl('dispositivos/crear') : url('inventario/crear');
    $otherModuleUrl = $module === 'dispositivos' ? url('inventario') : redUrl('dispositivos/index');
    ?>
    <header class="topbar">
        <div class="container nav-wrap">
            <div class="brand">
                <div class="brand-mark">UTS</div>
                <div>
                    <strong><?= htmlspecialchars($moduleName) ?></strong>
                    <small>Departamento</small>
                </div>
            </div>
            <nav class="main-nav">
                <a href="<?= $moduleUrl ?>">Inicio</a>
                <a href="<?= $createUrl ?>">Nuevo registro</a>
                <a href="<?= $otherModuleUrl ?>">
                    <?= $module === 'dispositivos' ? 'Inventario' : 'Dispositivos de red' ?>
                </a>
            </nav>
        </div>
    </header>
    <main class="page-shell">
