<?php


require_once dirname(__FILE__)."/Util/Connection.php";
$sal=array();
$sal["Estado"]="error";
$sal["Descripcion"]="Error desconocido";
$con= getConnection();
if(!isset($_SESSION["usuario"])||$_SESSION["usuario"]["tipo"]!=0)
{
    $sal["Descripcion"]="Usuario no valido";
}else{
if($con->connect_errno)
{
    $sal["Descripcion"]="No se pudo conectar a la base de datos, contacte al administrador";
}else
{
    $idActividad=$con->real_escape_string($_POST["idActividad"]);
    $idUsuario=$con->real_escape_string($_SESSION["usuario"]["idUsuario"]);
    
    $tipo=$_FILES["tarea"]["type"];
    $nombre=$_FILES["tarea"]["name"];
    $data=$con->real_escape_string(file_get_contents($_FILES["tarea"]["tmp_name"]));
    
    $query1="SELECT idArchivo FROM entrega WHERE idUsuario='$idUsuario' AND idActividad='$idActividad'";
    if($result=$con->query($query)){
        if($row=$result1->fetch_assoc())
        {
            $idArchivo=$row["idArchivo"];
            $query2="UPDATE archivo SET tipo='$tipo', nombre='$nombre',data='$data' WHERE idArchivo='$idArchivo'";
        $sal["Estado"]="ok";
        unset($sal["Descripcion"]);
        }
        $result->free();
    }
    else
    {
        $sal["Descripcion"]="No se pudieron actualizar los datos.\n".$con->error;
    }
    
    $con->close();
}
}

header('Content-type: application/json');
echo json_encode($sal);

