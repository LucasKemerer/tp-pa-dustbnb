<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: departamentos.php');
    exit;
}

require 'includes/conexion.php';

if ($conexion === null) {
    header('Location: departamentos.php');
    exit;
}

$accion = isset($_POST['accion']) ? $_POST['accion'] : '';
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
$capacidad = isset($_POST['capacidad']) ? (int) $_POST['capacidad'] : 0;
$precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 0;
$disponible = isset($_POST['disponible']) && $_POST['disponible'] === '1' ? 1 : 0;

$datosValidos = $nombre !== '' && $direccion !== '' && $capacidad >= 1 && $precio > 0;

try {
    if ($accion === 'alta' && $datosValidos) {
        $consulta = $conexion->prepare('INSERT INTO departamentos (nombre, direccion, capacidad, precio_noche, disponible) VALUES (?, ?, ?, ?, ?)');
        $consulta->execute([$nombre, $direccion, $capacidad, $precio, $disponible]);
        $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento agregado correctamente'];
    } elseif ($accion === 'modificacion' && $id > 0 && $datosValidos) {
        $consulta = $conexion->prepare('UPDATE departamentos SET nombre = ?, direccion = ?, capacidad = ?, precio_noche = ?, disponible = ? WHERE id = ?');
        $consulta->execute([$nombre, $direccion, $capacidad, $precio, $disponible, $id]);
        $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento modificado correctamente'];
    } elseif ($accion === 'baja' && $id > 0) {
        $consulta = $conexion->prepare('DELETE FROM departamentos WHERE id = ?');
        $consulta->execute([$id]);
        $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento eliminado correctamente'];
    } else {
        $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Los datos ingresados no son válidos'];
    }
} catch (PDOException $e) {
    $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'No pudimos guardar los cambios, intentá nuevamente'];
}

header('Location: departamentos.php');
exit;
