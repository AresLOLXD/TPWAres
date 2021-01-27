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
        $query = "SELECT E.calificacion,E.fechaEntrega ,E.idArchivo,U.idUsuario,U.username  FROM entrega AS E INNER JOIN usuario AS U ON U.idUsuario=E.idUsuario  WHERE E.idActividad='$idActividad' ";
        if ($result = $con->query($query)) {
            $sal["Registros"] = array();
            $sal["Estado"] = "ok";
            unset($sal["Descripcion"]);

            while ($row = $result->fetch_assoc()) {
                $sal["Registros"][] = $row;
            }

            $query = "SELECT titulo  FROM actividad WHERE idActividad='$idActividad' ";
            if ($result2 = $con->query($query)) {
                $sal["Estado"] = "ok";
                if ($row = $result2->fetch_assoc()) {
                    $sal["titulo"] = $row["titulo"];
                }

                $result2->free();
            } else {
                $sal["Descripcion"] = "Error de la base.\n" . $con->error;
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
