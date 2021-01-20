<?php 
if(isset($_SESSION["usuario"]))
{
    switch($_SESSION["usuario"]["tipo"])
    {
        case 0:
            header('Location: /Alumno/inicio.php');
            die();
            break;
        case 1:
            header('Location: /Profesor/inicio.php');
            die();
            break;
        case 2:
            header('Location: /Admin/inicio.php');
            die();
            break;
        default:
            if(!session_destroy())
            {
                session_unset();
            }
            header('Location: /login.php');
            die();
            break;
    }
}