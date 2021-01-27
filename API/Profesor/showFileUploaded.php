<?php
require_once dirname(dirname(dirname(__FILE__))) . "/Util/Connection.php";

$con = getConnection();
if (!isset($_SESSION["usuario"]) || $_SESSION["usuario"]["tipo"] != 1) {
    header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden", true, 403);
    echo "<h1>El usuario no tiene permisos para ver el archivo</h1>";
    die();
} else {
    if ($con->connect_errno) {
        $sal["Descripcion"] = "No se pudo conectar a la base de datos, contacte al administrador";
    } else {
        $idArchivo = $con->real_escape_string($_GET["idArchivo"]);
        $query = "SELECT tipo,nombre,data FROM archivo WHERE idArchivo='$idArchivo' LIMIT 1";
        if ($result = $con->query($query)) {
            if ($row = $result->fetch_assoc()) {
                header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
                header("Cache-Control: public"); // needed for internet explorer
                header("Content-Type: " . $row["tipo"]);
                header("Content-Disposition: inline; filename=" . $row["nombre"]);
                echo $row["data"];
                die();
            } else {
                header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
                echo "<h1>El usuario no tiene permisos para ver el archivo</h1>";
                die();
            }
            $result->free();
        }
        $con->close();
    }
}
