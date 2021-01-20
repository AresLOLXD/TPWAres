<?php
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"]!=1)
{
    header('Location: /login.php');
    die();
}

