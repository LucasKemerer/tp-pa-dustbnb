<?php

session_start();

require 'controladores/DepartamentoController.php';

$controlador = new DepartamentoController();
$controlador->listar();
