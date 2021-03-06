<?php

require_once dirname(dirname(__FILE__)) . "/Util/Connection.php";

$sal = array();
$sal["Estado"] = "error";
$sal["Descripcion"] = "Error desconocido";
$con = getConnection();
if (isset($_SESSION["usuario"])) {
    $sal["Descripcion"] = "Usuario ya existente";
} else {
    if ($con->connect_errno) {
        $sal["Descripcion"] = "No se pudo conectar a la base de datos, contacte al administrador";
    } else {
        $usuario = $con->real_escape_string($_POST["username"]);
        $password = $con->real_escape_string(md5($_POST["password"]));

        $query = "SELECT idUsuario,nombre,apPat,apMat,tipo FROM usuario WHERE username='$usuario' AND password='$password' LIMIT 1";
        if ($result = $con->query($query)) {
            if ($row = $result->fetch_assoc()) {
                $_SESSION["usuario"] = $row;

                $sal["Estado"] = "ok";
                $sal["tipo"] = intval($row["tipo"]);
                unset($sal["Descripcion"]);
            } else {
                $sal["Descripcion"] = "Usuario o contraseña errorenea";
            }
            $result->free();
        }
        $con->close();
    }
}

header('Content-type: application/json');
echo json_encode($sal);
