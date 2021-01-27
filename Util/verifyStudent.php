<?php
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 0) {
    header('Location: /TPW/login.php');
    die();
}
