<?php
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"]!=0)
{
    header('Location: /login.php');
    die();
}

