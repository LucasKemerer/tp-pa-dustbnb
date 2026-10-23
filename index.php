<?php

session_start();

require 'controladores/LoginController.php';

$controlador = new LoginController();
$controlador->mostrarLogin();
