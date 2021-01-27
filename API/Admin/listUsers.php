<?php

require_once dirname(dirname(dirname(__FILE__))) . "/Util/Connection.php";
$sal = array();
$sal["Estado"] = "error";
$sal["Descripcion"] = "Error desconocido";
$con = getConnection();
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 2) {
    $sal["Descripcion"] = "Usuario no valido";
} else {
    if ($con->connect_errno) {
        $sal["Descripcion"] = "No se pudo conectar a la base de datos, contacte al administrador";
    } else {
        $texto = $con->real_escape_string($_POST["texto"]);

        $query = "SELECT idUsuario,nombre,username,apPat,apMat,tipo FROM usuario WHERE nombre LIKE '%$texto%' OR username LIKE '%$texto%' OR apPat LIKE '%$texto%' OR apMat LIKE '%$texto%' ORDER BY idUsuario ASC ";
        if ($result = $con->query($query)) {
            $sal["Estado"] = "ok";
            unset($sal["Descripcion"]);

            $sal["Registros"] = array();
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
