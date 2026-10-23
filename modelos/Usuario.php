<?php

class Usuario
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    // Devuelve true si el usuario existe y la contraseña coincide
    public function autenticar($usuario, $contrasena)
    {
        $consulta = $this->conexion->prepare('SELECT contrasena FROM usuarios WHERE usuario = ?');
        $consulta->execute([$usuario]);
        $registro = $consulta->fetch(PDO::FETCH_ASSOC);

        return $registro !== false && password_verify($contrasena, $registro['contrasena']);
    }
}
