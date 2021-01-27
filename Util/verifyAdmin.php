<?php
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 2) {
    header('Location: /TPW/login.php');
    die();
}
