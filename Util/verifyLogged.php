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
            if(session_unset())
            {
                error_log("Ay drake, se murio esto");
                die();
            }
            header('Location: /login.php');
            die();
            break;
    }
}