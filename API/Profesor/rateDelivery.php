<?php

require_once dirname(dirname(dirname(__FILE__))) . "/Util/Connection.php";
$sal = array();
$sal["Estado"] = "error";
$sal["Descripcion"] = "Error desconocido";
$con = getConnection();
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 1) {
    $sal["Descripcion"] = "Usuario no valido";
} else {
    if ($con->connect_errno) {
        $sal["Descripcion"] = "No se pudo conectar a la base de datos, contacte al administrador";
    } else {
        $idActividad = $con->real_escape_string($_POST["idActividad"]);
        $calificacion = $con->real_escape_string($_POST["calificacion"]);
        $idUsuario = $con->real_escape_string($_POST["idUsuario"]);

        $query = "UPDATE entrega SET calificacion='$calificacion' WHERE idUsuario='$idUsuario' AND idActividad='$idActividad'";
        if ($con->query($query) === true) {
            $sal["Estado"] = "ok";
            unset($sal["Descripcion"]);
        } else {
            $sal["Descripcion"] = "No se pudieron actualizar los datos.\n" . $con->error;
        }

        $con->close();
    }
}

header('Content-type: application/json');
echo json_encode($sal);
