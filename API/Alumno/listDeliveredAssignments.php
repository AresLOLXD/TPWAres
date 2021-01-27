<?php

require_once dirname(dirname(dirname(__FILE__))) . "/Util/Connection.php";
$sal = array();
$sal["Estado"] = "error";
$sal["Descripcion"] = "Error desconocido";
$con = getConnection();
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 0) {
    $sal["Descripcion"] = "Usuario no valido";
} else {
    if ($con->connect_errno) {
        $sal["Descripcion"] = "No se pudo conectar a la base de datos, contacte al administrador";
    } else {
        $idUsuario = $con->real_escape_string($_SESSION["usuario"]["idUsuario"]);

        $query = "SELECT A.idActividad,E.calificacion,AR.nombre FROM actividad AS A INNER JOIN entrega AS E ON E.idActividad=A.idActividad INNER JOIN archivo AS AR ON AR.idArchivo=E.idArchivo WHERE E.idUsuario='$idUsuario'  ORDER BY A.idActividad ASC ";
        if ($result = $con->query($query)) {
            $sal["Registros"] = array();
            $sal["Estado"] = "ok";

            while ($row = $result->fetch_assoc()) {
                $sal["Registros"][] = $row;
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
