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
        $username = $con->real_escape_string($_POST["username"]);
        $password = $con->real_escape_string(md5($_POST["password"]));
        $apMat = $con->real_escape_string($_POST["apMat"]);
        $apPat = $con->real_escape_string($_POST["apPat"]);
        $nombre = $con->real_escape_string($_POST["nombre"]);
        $tipo = $con->real_escape_string($_POST["tipo"]);

        $query = "INSERT INTO usuario(nombre,apPat,apMat,username,password,tipo)  VALUES ('$nombre','$apPat','$apMat','$username','$password','$tipo')";
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
