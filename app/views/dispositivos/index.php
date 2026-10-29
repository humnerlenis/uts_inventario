<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="hero">
    <div class="container hero-content">
        <div>
            <span class="eyebrow">Panel de control</span>
            <h1>Dispositivos de red</h1>
            <p>Registra y consulta los dispositivos asignados a cada usuario.</p>
        </div>
        <a class="btn btn-primary" href="<?= redUrl('dispositivos/crear') ?>">Registrar dispositivo</a>
    </div>
</section>

<section class="container content-section">
    <?php if ($mensaje !== ''): ?>
        <div class="notice notice-success" role="status"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <div class="table-card card">
        <div class="table-header">
            <h2>Dispositivos registrados</h2>
            <span><?= count($items) ?> registros</span>
        </div>

        <?php if ($items === []): ?>
            <div class="empty-state">
                <p>Aún no hay dispositivos registrados.</p>
                <a class="btn btn-primary" href="<?= redUrl('dispositivos/crear') ?>">Registrar el primero</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IP</th>
                            <th>MAC</th>
                            <th>Interfaz</th>
                            <th>Host</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= (int) $item['id'] ?></td>
                                <td><?= htmlspecialchars($item['ip'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['mac'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['interfaz'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['host'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['responsable'], ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
