<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
require_once dirname(__FILE__)."/Util/Connection.php";
require_once dirname(dirname(__FILE__))."/lib/FPDF/fpdf.php";
require_once dirname(dirname(__FILE__))."/lib/FPDF/fpdf.php";

$con= getConnection();
if(!isset($_SESSION["usuario"])||$_SESSION["usuario"]["tipo"]!=0)
{
    header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden",true,403);
    echo "<h1>El usuario no tiene permisos para ver el archivo</h1>";
    die();
}else{
if($con->connect_errno)
{
    $sal["Descripcion"]="No se pudo conectar a la base de datos, contacte al administrador";
}else
{
    $idActividad=$con->real_escape_string($_GET["idActividad"]);
    $query="SELECT paginas,titulo FROM actividad WHERE idActividad='$idActividad' LIMIT 1";
    if($result=$con->query($query)){
        if($row=$result->fetch_assoc()){
            $pdf = new Fpdi();
            $pdf->setSourceFile(dirname(dirname(__FILE__))."/public/libro.pdf");
            $paginas=json_decode($row["paginas"]);
            foreach($paginas as $pag)
            {
                $templateId = $pdf->importPage($pag);
                $size = $pdf->getTemplateSize($templateId);
                if ($size['w'] > $size['h']) {
                    $pdf->AddPage('L', array($size['w'], $size['h']));
                } else {
                    $pdf->AddPage('P', array($size['w'], $size['h']));
                }
                $pdf->Output("I","Actividad \"{$row['titulo']}\"");
            }
        }
        else
        {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found",true,404);
            echo "<h1>El usuario no tiene permisos para ver el archivo</h1>";
            die();
        }
        $result->free();
    }
    $con->close();
}
}


