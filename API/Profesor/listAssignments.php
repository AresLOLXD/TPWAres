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
        $texto = $con->real_escape_string($_POST["texto"]);

        $query = "SELECT idActividad,titulo FROM actividad WHERE titulo LIKE '%$texto%' ORDER BY idActividad ASC ";
        if ($result = $con->query($query)) {
            $sal["Registros"] = array();
            while ($row = $result->fetch_assoc()) {
                $sal["Estado"] = "ok";
                $sal["Registros"][] = $row;
                unset($sal["Descripcion"]);
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
