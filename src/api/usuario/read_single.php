<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Usuario.php';

    $database = new Database();
    $db = $database->connect();

    $usuario = new Usuario($db);

    $usuario->id = isset($_GET['id']) ? $_GET['id'] : die();

    $usuario->read_single();

    $usuario_arr = array(
        'id' => $usuario->id,
        'nombre_usuario' => $usuario->nombre_usuario,
        'contrasena' => $usuario->contrasena

    );

    print_r(json_encode($usuario_arr));