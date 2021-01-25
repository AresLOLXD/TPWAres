<?php



require_once dirname(__FILE__)."/Util/Connection.php";
$sal=array();
$sal["Estado"]="error";
$sal["Descripcion"]="Error desconocido";
$con= getConnection();
if(!isset($_SESSION["usuario"])||$_SESSION["usuario"]["tipo"]!=2)
{
    $sal["Descripcion"]="Usuario no valido";
}else{
if($con->connect_errno)
{
    $sal["Descripcion"]="No se pudo conectar a la base de datos, contacte al administrador";
}else
{
    $idUsuario=$con->real_escape_string($_POST["idUsuario"]);
    
    $query="SELECT * FROM usuario WHERE idUsuario='$idUsuario' LIMIT 1";
    if($result=$con->query($query)){
        if($row=$result->fetch_assoc())
        {
            $sal["Estado"]="ok";
            $sal["Registro"]=$row;
            unset($sal["Descripcion"]);
        }else
        {
            $sal["Descripcion"]="No se encontro el usuario";
        }
        $result->free();
    }
    else
    {
        $sal["Descripcion"]="Error de la base.\n".$con->error;
    }
    
    $con->close();
}
}

header('Content-type: application/json');
echo json_encode($sal);

