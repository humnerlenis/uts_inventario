<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="container content-section">
    <div class="card form-card" style="text-align:center; padding: 50px 24px;">
        <span class="eyebrow">Error 404</span>
        <h2>Página no encontrada</h2>
        <p>La ruta solicitada no existe o fue eliminada.</p>
        <a class="btn btn-primary" href="<?= redUrl('dispositivos/index') ?>">Volver al inicio</a>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
