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
        $idActividad = $con->real_escape_string($_POST["idActividad"]);
        $idUsuario = $con->real_escape_string($_SESSION["usuario"]["idUsuario"]);

        $tipo = $_FILES["tarea"]["type"];
        $nombre = $_FILES["tarea"]["name"];
        $data = $con->real_escape_string(file_get_contents($_FILES["tarea"]["tmp_name"]));

        $query = "INSERT INTO archivo(tipo,nombre,data) VALUES('$tipo','$nombre','$data')";
        if ($con->query($query) === true) {
            $idArchivo = $con->insert_id;
            $query = "INSERT INTO entrega(idUsuario,idActividad,idArchivo) VALUES('$idUsuario','$idActividad','$idArchivo')";
            if ($con->query($query) === true) {
                $sal["Estado"] = "ok";
                unset($sal["Descripcion"]);
            } else {
                $sal["Descripcion"] = "No se pudieron registrar los datos.\n" . $con->error;

            }

        } else {
            $sal["Descripcion"] = "No se pudieron registrar los datos.\n" . $con->error;
        }

        $con->close();
    }
}

header('Content-type: application/json');
echo json_encode($sal);
