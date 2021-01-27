<?php

if (isset($_SESSION["usuario"])) {
    switch ($_SESSION["usuario"]["tipo"]) {
        case 0:
            header('Location: /TPW/Alumno/tareas.php');
            die();
            break;
        case 1:
            header('Location: /TPW/Profesor/tareas.php');
            die();
            break;
        case 2:
            header('Location: /TPW/TPW/Admin/usuarios.php');
            die();
            break;
        default:

            session_unset();
            session_destroy();
            session_write_close();
            setcookie(session_name(), '', 0, '/');
            session_regenerate_id(true);

            header('Location: /TPW/login.php');
            die();
            break;
    }
}
