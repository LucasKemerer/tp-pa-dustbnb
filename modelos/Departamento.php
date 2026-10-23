<?php

class Departamento
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function listar()
    {
        return $this->conexion->query('SELECT * FROM departamentos ORDER BY id')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id)
    {
        $consulta = $this->conexion->prepare('SELECT * FROM departamentos WHERE id = ?');
        $consulta->execute([$id]);
        $registro = $consulta->fetch(PDO::FETCH_ASSOC);

        return $registro !== false ? $registro : null;
    }

    public function agregar($nombre, $direccion, $capacidad, $precio, $disponible)
    {
        $consulta = $this->conexion->prepare('INSERT INTO departamentos (nombre, direccion, capacidad, precio_noche, disponible) VALUES (?, ?, ?, ?, ?)');
        $consulta->execute([$nombre, $direccion, $capacidad, $precio, $disponible]);
    }

    public function modificar($id, $nombre, $direccion, $capacidad, $precio, $disponible)
    {
        $consulta = $this->conexion->prepare('UPDATE departamentos SET nombre = ?, direccion = ?, capacidad = ?, precio_noche = ?, disponible = ? WHERE id = ?');
        $consulta->execute([$nombre, $direccion, $capacidad, $precio, $disponible, $id]);
    }

    public function eliminar($id)
    {
        $consulta = $this->conexion->prepare('DELETE FROM departamentos WHERE id = ?');
        $consulta->execute([$id]);
    }
}
