<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="hero">
    <div class="container hero-content">
        <div>
            <span class="eyebrow">Panel de control</span>
            <h1>Inventario por departamento</h1>
            <p>Registra y consulta los equipos disponibles en cada área de la institución.</p>
        </div>
        <a class="btn btn-primary" href="<?= url('inventario/crear') ?>">Agregar equipo</a>
    </div>
</section>

<section class="container content-section">
    <div class="toolbar card">
        <form method="GET" action="<?= url('inventario') ?>" class="filters">
            <div class="field">
                <label for="ubicacion">Filtrar por ubicación</label>
                <select id="ubicacion" name="ubicacion">
                    <option value="">Todas las ubicaciones</option>
                    <?php foreach ($ubicaciones as $row): ?>
                        <option value="<?= htmlspecialchars($row['ubicacion']) ?>" <?= $row['ubicacion'] === $ubicacionSeleccionada ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['ubicacion']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button class="btn btn-secondary" type="submit">Aplicar filtro</button>
        </form>
    </div>

    <div class="table-card card">
        <div class="table-header">
            <h2>Listado de equipos</h2>
            <span><?= count($items) ?> registros</span>
        </div>

        <?php if (empty($items)): ?>
            <div class="empty-state">
                <p>No hay equipos registrados para esta ubicación.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Marca/Modelo</th>
                            <th>Serial</th>
                            <th>Ubicación</th>
                            <th>Color</th>
                            
                            <th>Estado</th>
                            
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= (int) $item['id_inventario'] ?></td>
                                <td><?= htmlspecialchars($item['tipo']) ?></td>
                                <td><?= htmlspecialchars($item['marca_y_modelo'] ?: '-') ?></td>
                                <td><?= htmlspecialchars($item['serial'] ?: '-') ?></td>
                                <td><?= htmlspecialchars($item['ubicacion']) ?></td>
                                <td><?= htmlspecialchars($item['color'] ?: '-') ?></td>
                                
                                <td><span class="status-badge"><?= htmlspecialchars($item['estado']) ?></span></td>
                                <td><?= (int) ($item['cantidad'] ?? 0) ?></td>
                                
                                <td class="actions-col">
                                    <button class="action-link view-action" type="button" data-item='<?= htmlspecialchars(json_encode([
                                        'id' => (int) $item['id_inventario'],
                                        'tipo' => $item['tipo'],
                                        'marca_y_modelo' => $item['marca_y_modelo'] ?? '',
                                        'serial' => $item['serial'] ?? '',
                                        'ubicacion' => $item['ubicacion'],
                                        'color' => $item['color'] ?? '',
                                        'estado' => $item['estado'],
                                        'cantidad' => (int) ($item['cantidad'] ?? 0),
                                        'caracteristicas' => $item['caracteristicas'] ?? '',
                                        'observacion' => $item['observacion'] ?? '',
                                    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') ?>'>Ver</button>
                                    <a class="action-link" href="<?= url('inventario/editar/' . (int) $item['id_inventario']) ?>">Editar</a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="modal" id="item-modal" hidden>
    <div class="modal-backdrop" data-modal-close></div>
    <section class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <div class="modal-header">
            <div>
                <span class="eyebrow">Detalle del registro</span>
                <h2 id="modal-title">Información del equipo</h2>
            </div>
            <button class="modal-close" type="button" aria-label="Cerrar" data-modal-close>&times;</button>
        </div>
        <dl class="details-grid">
            <div><dt>ID</dt><dd data-detail="id"></dd></div>
            <div><dt>Tipo</dt><dd data-detail="tipo"></dd></div>
            <div><dt>Marca y modelo</dt><dd data-detail="marca_y_modelo"></dd></div>
            <div><dt>Serial</dt><dd data-detail="serial"></dd></div>
            <div><dt>Ubicación</dt><dd data-detail="ubicacion"></dd></div>
            <div><dt>Color</dt><dd data-detail="color"></dd></div>
            <div><dt>Estado</dt><dd data-detail="estado"></dd></div>
            <div><dt>Cantidad</dt><dd data-detail="cantidad"></dd></div>
            <div class="detail-full"><dt>Características</dt><dd data-detail="caracteristicas"></dd></div>
            <div class="detail-full"><dt>Observación</dt><dd data-detail="observacion"></dd></div>
        </dl>
    </section>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
