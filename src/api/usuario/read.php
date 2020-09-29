<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Usuario.php';

    $database = new Database();
    $db = $database->connect();

    $usuario = new Usuario($db);

    $result = $usuario->read();

    $num = $result->rowCount();

    if($num > 0) {

        $usuario_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $usuario_item = array(
            'id' => $id,
            'nombre_usuario' => $nombre_usuario,
            'contrasena' => $contrasena
        );

        array_push($usuario_arr, $usuario_item);
        }

        echo json_encode($usuario_arr);

    } else {
        echo json_encode(
        array('mensaje' => 'Sin resultados de usuarios')
        );
    }