<?php 
if(isset($_SESSION["usuario"]))
{
    switch($_SESSION["usuario"]["tipo"])
    {
        case 0:
            header('Location: /login.php');
            die();
            break;
        case 1:
            header('Location: /login.php');
            die();
            break;
        case 2:
            header('Location: /login.php');
            die();
            break;
        default:
            header('Location: /login.php');
            die();
            break;
    }
}