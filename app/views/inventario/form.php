<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="container content-section">
    <div class="form-card card">
        <div class="section-header">
            <div>
                <span class="eyebrow">Inventario</span>
                <h2><?= $modo === 'editar' ? 'Actualizar equipo' : 'Registrar equipo' ?></h2>
            </div>
            <a class="btn btn-ghost" href="<?= url('inventario') ?>">Volver</a>
        </div>

        <form method="POST" action="<?= url('inventario/guardar') ?>" class="inventory-form">
            <input type="hidden" name="id_inventario" value="<?= htmlspecialchars((string) ($item['id_inventario'] ?? 0)) ?>">

            <div class="form-grid">
                <div class="field">
                    <label for="tipo">Tipo de equipo</label>
                    <input id="tipo" name="tipo" type="text" value="<?= htmlspecialchars($item['tipo'] ?? '') ?>" required>
                </div>

                <div class="field">
                    <label for="marca_y_modelo">Marca y modelo</label>
                    <input id="marca_y_modelo" name="marca_y_modelo" type="text" value="<?= htmlspecialchars($item['marca_y_modelo'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="serial">Serial</label>
                    <input id="serial" name="serial" type="text" value="<?= htmlspecialchars($item['serial'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="ubicacion">Ubicación / departamento</label>
                    <select id="ubicacion" name="ubicacion" required>
                        <option value="">Seleccione</option>
                        <?php
                        $ubicaciones = [
                            'ADMINISTRACION',
                            'BIBLIOTECA',
                            'CAJA',
                            'CONTABILIDAD',
                            'CONTROL DE ESTUDIO',
                            'COORDINACION DE EXTENSIÓN',
                            'DIVISION DE PERSONAL',
                            'EXTENSION UNIVERSITARIA',
                            'INVESTIGACIÓN Y PASANTÍA',
                            'JEFATURA DE CARRERAS',
                            'JEFATURA DE ESCUELAS',
                            'LABORATORIO',
                            'PASANTIA Y TEG',
                            'PROMOCION Y DIFUSION',
                            'PROVEDURIA',
                            'SERVICIO COMUNITARIO',
                            'SERVIDOR PB',
                            'OTRO',
                        ];
                        foreach ($ubicaciones as $opcion):
                            $selected = (($item['ubicacion'] ?? '') === $opcion) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($opcion) . '" ' . $selected . '>' . htmlspecialchars($opcion) . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="field">
                    <label for="color">Color</label>
                    <input id="color" name="color" type="text" value="<?= htmlspecialchars($item['color'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" required>
                        <option value="">Seleccione</option>
                        <?php foreach (['Activo', 'En mantenimiento', 'Dañado', 'En revisión', 'En desuso'] as $estado): ?>
                            <option value="<?= $estado ?>" <?= (($item['estado'] ?? '') === $estado) ? 'selected' : '' ?>><?= $estado ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="field field-full">
                    <label for="caracteristicas">Características</label>
                    <input id="caracteristicas" name="caracteristicas" type="text" value="<?= htmlspecialchars($item['caracteristicas'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad" name="cantidad" type="number" min="0" value="<?= htmlspecialchars((string) ($item['cantidad'] ?? 1)) ?>">
                </div>

                <div class="field field-full">
                    <label for="observacion">Observación</label>
                    <textarea id="observacion" name="observacion" rows="4"><?= htmlspecialchars($item['observacion'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary" type="submit"><?= $modo === 'editar' ? 'Guardar cambios' : 'Registrar equipo' ?></button>
                <a class="btn btn-secondary" href="<?= url('inventario') ?>">Cancelar</a>
            </div>
        </form>
    </div>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
