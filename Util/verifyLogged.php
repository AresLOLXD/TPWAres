<?php

if (isset($_SESSION["usuario"])) {
    switch ($_SESSION["usuario"]["tipo"]) {
        case 0:
            header('Location: /TPWAres/Alumno/inicio.php');
            die();
            break;
        case 1:
            header('Location: /TPWAres/Profesor/inicio.php');
            die();
            break;
        case 2:
            header('Location: /TPWAres/Admin/inicio.php');
            die();
            break;
        default:

            session_unset();
            session_destroy();
            session_write_close();
            setcookie(session_name(), '', 0, '/');
            session_regenerate_id(true);

            header('Location: /TPWAres/login.php');
            die();
            break;
    }
}
