<?php
// 1. Traemos la cabecera (con Bootstrap y tu logo)
require 'includes/header.php';
?>

<!-- Centramos todo con el sistema de grillas de Bootstrap -->
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <!-- Le decimos que ocupe 4 columnas (de 12) en compu, y el 100% en celu -->
    <div class="col-md-4 col-sm-10">
        
        <!-- Armamos la "Tarjeta" -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="text-center mb-4">Iniciar Sesión</h4>
                
                <!-- EL FORMULARIO -->
                <!-- Apunta a procesoLogin.php (Fase 5) y va por POST -->
                <form id="loginForm" action="procesoLogin.php" method="POST">
                    
                    <!-- Campo Usuario -->
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <!-- El ID es importantísimo para que JS lo encuentre después -->
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ej: fcytuader">
                    </div>
                    
                    <!-- Campo Contraseña -->
                    <div class="mb-4">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                    </div>
                    
                    <!-- Botón de Envío -->
                    <div class="d-grid">
                        <!-- ATENCIÓN: Le pongo el atributo 'disabled' porque el TP pide que arranque deshabilitado -->
                        <button type="submit" class="btn btn-primary text-white" id="btnIngresar" disabled>
                            Ingresar
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<?php
// 2. Traemos el footer (cierra etiquetas y carga los scripts)
require 'includes/footer.php';
?>