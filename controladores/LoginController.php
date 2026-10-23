<?php

require_once 'modelos/Usuario.php';

class LoginController
{
    // Muestra el formulario de login con un captcha nuevo
    public function mostrarLogin()
    {
        if (isset($_SESSION['usuario'])) {
            header('Location: inicio.php');
            exit;
        }

        $_SESSION['captcha'] = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);

        require 'vistas/login.php';
    }

    // Valida captcha + usuario y contraseña
    public function procesarLogin()
    {
        require 'includes/conexion.php';

        $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';
        $captcha = isset($_POST['captcha']) ? strtoupper(trim($_POST['captcha'])) : '';
        $captchaGenerado = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';
        unset($_SESSION['captcha']);

        $esPost = $_SERVER['REQUEST_METHOD'] === 'POST';
        $captchaCorrecto = $captchaGenerado !== '' && hash_equals($captchaGenerado, $captcha);
        $autenticado = false;

        if ($esPost && $captchaCorrecto && $conexion !== null) {
            try {
                $modelo = new Usuario($conexion);
                $autenticado = $modelo->autenticar($usuario, $contrasena);
            } catch (PDOException $e) {
                $conexion = null;
            }
        }

        if ($autenticado) {
            session_regenerate_id(true);
            $_SESSION['usuario'] = $usuario;
            header('Location: inicio.php');
            exit;
        }

        if ($conexion === null) {
            $motivo = 'No pudimos conectarnos con la base de datos';
            $detalle = 'El servicio no está disponible en este momento, intentá nuevamente en unos minutos';
        } else {
            $motivo = $captchaCorrecto ? 'Usuario o contraseña incorrectos' : 'El código ingresado no coincide';
            $detalle = 'Verificá los datos ingresados y volvé a intentarlo';
        }

        $ocultar_nav = true; // variable para ocultar el header
        require 'vistas/error_login.php';
    }
}
