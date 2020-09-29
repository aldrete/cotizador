<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/Database.php';
include_once '../../models/Usuario.php';


$database = new Database();
$db = $database->connect();

$usuario = new Usuario($db);

if(isset($_POST))
{

    if($usuario->login($_POST['nombre_usuario'],$_POST['contrasena']))
    {
        $_SESSION['LoggedIn'] = '1';
        $_SESSION['nombre_usuario'] = $_POST['nombre_usuario'];
    }

}
if(isset($_SESSION['LoggedIn']))
{
    header('location: dashboard.php');
    exit();
}
?>