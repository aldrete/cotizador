<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Usuario.php';

    $database = new Database();
    $db = $database->connect();

    $usuario = new Usuario($db);

    $data = json_decode(file_get_contents("php://input"));

    $usuario->id = $data->id;
    $usuario->nombre_usuario = $data->nombre_usuario;
    $usuario->contrasena = $data->contrasena;

    if($usuario->update()) {
        echo json_encode(
        array('mensaje' => 'Usuario actualizado')
        );
    } else {
        echo json_encode(
        array('mensaje' => 'Usuario NO actualizado')
        );
    }