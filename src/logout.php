<?php
    session_start();
    unset($_SESSION['LoggedIn']);
    session_destroy();
    header('Location: index.php');
    exit();
?>