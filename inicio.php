<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

require 'includes/header.php';
?>

<div class="row justify-content-center align-items-center w-100 m-0">
    <div class="col-md-5 col-sm">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center p-4">
                <h4 class="mb-4">Bienvenido a dustbnb</h4>
                <h6 class="mb-4">Ingreso de sesión exitoso</h6>

                <p class="mb-4">
                    Este sistema está diseñado para la gestión y administracion de reservas de alojamientos temporales.
                    Permitirá controlar la disponibilidad de los departamentos y mantener el registro de huéspedes.
                </p>

                <a href="cerrarSesion.php" class="btn btn-outline-danger px-4 py-2">
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</div>

<?php
require 'includes/footer.php';
?>
