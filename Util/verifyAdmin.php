<?php
error_log(print_r($_SESSION, true));
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 2) {
    header('Location: /TPWAres/login.php');
    die();
}
