<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="container content-section">
    <div class="form-card card">
        <div class="section-header">
            <div>
                <span class="eyebrow">Red institucional</span>
                <h2>Registrar dispositivo</h2>
            </div>
            <a class="btn btn-ghost" href="<?= redUrl('dispositivos/index') ?>">Volver</a>
        </div>

        <?php if ($errors !== []): ?>
            <div class="notice notice-error" role="alert">
                <strong>No se pudo registrar el dispositivo.</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= redUrl('dispositivos/guardar') ?>" class="device-form">
            <div class="form-grid">
                <div class="field">
                    <label for="ip">Dirección IP</label>
                    <input id="ip" name="ip" type="text" maxlength="20" value="<?= htmlspecialchars($data['ip'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required <?= isset($errors['ip']) ? 'aria-describedby="ip-error"' : '' ?>>
                    <?php if (isset($errors['ip'])): ?>
                        <small class="field-error" id="ip-error"><?= htmlspecialchars($errors['ip'], ENT_QUOTES, 'UTF-8') ?></small>
                    <?php endif; ?>
                </div>

                <div class="field">
                    <label for="mac">Dirección MAC</label>
                    <input id="mac" name="mac" type="text" maxlength="20" value="<?= htmlspecialchars($data['mac'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="field">
                    <label for="interfaz">Interfaz</label>
                    <select id="interfaz" name="interfaz" required>
                        <option value="">Seleccione</option>
                        <?php foreach (['Wireless', 'Ethernet'] as $interfaz): ?>
                            <option value="<?= $interfaz ?>" <?= ($data['interfaz'] ?? '') === $interfaz ? 'selected' : '' ?>><?= $interfaz ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field">
                    <label for="host">Host</label>
                    <input id="host" name="host" type="text" maxlength="20" value="<?= htmlspecialchars($data['host'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>

                <div class="field field-full">
                    <label for="responsable">Responsable</label>
                    <input id="responsable" name="responsable" type="text" maxlength="100" value="<?= htmlspecialchars($data['responsable'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit">Registrar dispositivo</button>
                <a class="btn btn-secondary" href="<?= redUrl('dispositivos/index') ?>">Cancelar</a>
            </div>
        </form>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
