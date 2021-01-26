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
        $paginas = json_encode($_POST["paginas"]);
        $fechaEntrega = "";
        if (isset($_POST["fechaEntrega"])) {
            $fechaEntrega = "'" . $con->real_escape_string($_POST["fechaEntrega"]) . "'";
        } else {
            $fechaEntrega = "NULL";
        }

        $titulo = $con->real_escape_string($_POST["titulo"]);

        $query = "INSERT INTO actividad(texto,paginas,fechaEntrega,titulo) VALUES('$texto','$paginas',$fechaEntrega,'$titulo')";
        if ($con->query($query) === true) {
            $sal["Estado"] = "ok";
            unset($sal["Descripcion"]);
        } else {
            $sal["Descripcion"] = "No se pudieron registrar los datos.\n" . $con->error;
        }

        $con->close();
    }
}

header('Content-type: application/json');
echo json_encode($sal);
