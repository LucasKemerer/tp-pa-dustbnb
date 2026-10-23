<?php
require 'includes/header.php';
?>

<?php if ($conexion === null): ?>
<div class="row justify-content-center align-items-center w-100 m-0">
    <div class="col-md-5 col-sm">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center p-4">
                <h4 class="mb-4">Oops, algo salió mal</h4>
                <h6 class="mb-2">No pudimos conectarnos con la base de datos</h6>
                <p class="mb-4">El servicio no está disponible en este momento, intentá nuevamente en unos minutos</p>

                <a href="inicio.php" class="btn btn-primary px-4 py-2">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="m-0">Departamentos</h4>
        <a href="inicio.php" class="btn btn-outline-secondary">← Volver al inicio</a>
    </div>

    <?php if ($mensaje !== null): ?>
        <div class="alert alert-<?= $mensaje['tipo'] ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje['texto']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="mb-4"><?= $editando ? 'Modificar departamento' : 'Nuevo departamento' ?></h5>

                    <form id="departamentoForm" action="procesoDepartamento.php" method="POST">
                        <input type="hidden" name="accion" value="<?= $editando ? 'modificacion' : 'alta' ?>">
                        <input type="hidden" name="id" value="<?= $editando ? $editando['id'] : '' ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="100" value="<?= $editando ? htmlspecialchars($editando['nombre']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" maxlength="150" value="<?= $editando ? htmlspecialchars($editando['direccion']) : '' ?>">
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="capacidad" class="form-label">Capacidad</label>
                                <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" step="1" value="<?= $editando ? $editando['capacidad'] : '' ?>">
                            </div>

                            <div class="col-6 mb-3">
                                <label for="precio" class="form-label">Precio por noche</label>
                                <input type="number" class="form-control" id="precio" name="precio" min="0.01" step="0.01" value="<?= $editando ? $editando['precio_noche'] : '' ?>">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="disponible" class="form-label">Disponible</label>
                            <select class="form-select" id="disponible" name="disponible">
                                <option value="1">Sí</option>
                                <option value="0" <?= $editando && !$editando['disponible'] ? 'selected' : '' ?>>No</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary text-white" id="btnGuardar" disabled>
                                <?= $editando ? 'Guardar cambios' : 'Agregar' ?>
                            </button>
                            <?php if ($editando): ?>
                                <a href="departamentos.php" class="btn btn-outline-secondary">Cancelar</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <table id="tablaDepartamentos" class="table table-hover align-middle w-100">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Capacidad</th>
                                <th>Precio por noche</th>
                                <th>Disponible</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departamentos as $departamento): ?>
                                <tr>
                                    <td><?= htmlspecialchars($departamento['nombre']) ?></td>
                                    <td><?= htmlspecialchars($departamento['direccion']) ?></td>
                                    <td><?= $departamento['capacidad'] ?></td>
                                    <td data-order="<?= $departamento['precio_noche'] ?>">$ <?= number_format($departamento['precio_noche'], 2, ',', '.') ?></td>
                                    <td>
                                        <?php if ($departamento['disponible']): ?>
                                            <span class="badge text-bg-success">Sí</span>
                                        <?php else: ?>
                                            <span class="badge text-bg-secondary">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="departamentos.php?editar=<?= $departamento['id'] ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                                        <form action="procesoDepartamento.php" method="POST" class="form-baja d-inline">
                                            <input type="hidden" name="accion" value="baja">
                                            <input type="hidden" name="id" value="<?= $departamento['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
require 'includes/footer.php';
?>
