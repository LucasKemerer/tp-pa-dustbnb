<?php
$usuarioValido = 'fcytuader';
$contrasenaValida = 'programacionavanzada';

$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
$esPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$autenticado = $esPost && hash_equals($usuarioValido, $usuario) && hash_equals($contrasenaValida, $contrasena);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del ingreso</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5 text-center">
        <?php if ($autenticado): ?>
            <h1>ingreso correctamente</h1>
            <a class="btn btn-primary text-white" href="index.php">Volver al formulario</a>
        <?php else: ?>
            <h1>Usuario o contraseña incorrectos</h1>
            <p>Verificá los datos e intentá nuevamente.</p>
            <a class="btn btn-primary text-white" href="index.php">Volver al formulario</a>
        <?php endif; ?>
    </main>
</body>
</html>
