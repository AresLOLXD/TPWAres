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
        $idUsuario = $con->real_escape_string($_POST["idUsuario"]);
        $query = "SELECT E.calificacion,E.idArchivo,U.username  FROM entrega AS E INNER JOIN usuario AS U ON U.idUsuario=E.idUsuario  WHERE E.idActividad='$idActividad' AND E.idUsuario='$idUsuario' ";
        if ($result = $con->query($query)) {
            if ($row = $result->fetch_assoc()) {
                $sal["Registro"][] = $row;
                $sal["Estado"] = "ok";
                unset($sal["Descripcion"]);
            } else {
                $sal["Descripcion"] = "No se encontro el registro";

            }

            $result->free();
        } else {
            $sal["Descripcion"] = "Error de la base.\n" . $con->error;
        }

        $con->close();
    }
}

header('Content-type: application/json');
echo json_encode($sal);
