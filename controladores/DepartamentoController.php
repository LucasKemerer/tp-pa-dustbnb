<?php

require_once 'modelos/Departamento.php';

class DepartamentoController
{
    // Arma el listado y el formulario de departamentos
    public function listar()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
            exit;
        }

        require 'includes/conexion.php';

        $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
        unset($_SESSION['mensaje']);

        $departamentos = [];
        $editando = null;

        if ($conexion !== null) {
            try {
                $modelo = new Departamento($conexion);
                $departamentos = $modelo->listar();

                if (isset($_GET['editar'])) {
                    $editando = $modelo->buscar((int) $_GET['editar']);
                }
            } catch (PDOException $e) {
                $conexion = null;
            }
        }

        require 'vistas/departamentos.php';
    }

    // Alta, baja y modificación
    public function procesar()
    {
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
            $modelo = new Departamento($conexion);

            if ($accion === 'alta' && $datosValidos) {
                $modelo->agregar($nombre, $direccion, $capacidad, $precio, $disponible);
                $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento agregado correctamente'];
            } elseif ($accion === 'modificacion' && $id > 0 && $datosValidos) {
                $modelo->modificar($id, $nombre, $direccion, $capacidad, $precio, $disponible);
                $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento modificado correctamente'];
            } elseif ($accion === 'baja' && $id > 0) {
                $modelo->eliminar($id);
                $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'Departamento eliminado correctamente'];
            } else {
                $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Los datos ingresados no son válidos'];
            }
        } catch (PDOException $e) {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'No pudimos guardar los cambios, intentá nuevamente'];
        }

        header('Location: departamentos.php');
        exit;
    }
}
