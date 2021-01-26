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
        $texto = $con->real_escape_string($_POST["texto"]);
        $pagina = $_POST["pagina"] - 1;
        $limit = 10;
        $skip = $limit * $pagina;
        $query = "SELECT idActividad,titulo FROM actividad WHERE titulo LIKE '%$text%' ORDER BY idActividad ASC LIMIT $skip,$limit";
        if ($result = $con->query($query)) {
            $sal["Registros"] = array();
            if ($row = $result->fetch_assoc()) {
                $sal["Estado"] = "ok";
                $sal["Registros"][] = $row;
                unset($sal["Descripcion"]);
            } else {
                $sal["Descripcion"] = "No se encontraron las tareas";
            }
            $query = "SELECT COUNT(idActividad) AS CANT FROM actividad WHERE titulo LIKE '%$text%' ";
            if ($result2 = $con->query($query)) {
                if ($row = $result2->fetch_assoc()) {
                    $sal["Cantidad"] = $row["CANT"];
                    unset($sal["Descripcion"]);
                } else {
                    $sal["Descripcion"] = "No se encontraron las tareas";
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
