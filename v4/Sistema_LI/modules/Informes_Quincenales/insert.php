<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$sql = "SELECT * FROM users WHERE user = '" . $_SESSION['user'] . "'";

$sql = "SELECT * FROM users WHERE user = '" . $_SESSION['user'] . "'";
if ($result = $conexion->query($sql)) {
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id'] = $row['user'];
				$_SESSION['name_user'] = $row['name'];
    }
}

$archivopdf = $_FILES["archivo"]["name"]; 


$sql = "SELECT archivopdf FROM infoq";  
$result = $conexion->query($sql); 
$row = mysqli_fetch_array($result);
$_SESSION['infoq_archivo']=$row['archivopdf'];
$nombrePDF=$_SESSION['infoq_archivo'];
    if ($nombrePDF==$archivopdf) {
        Info('Ya existe un archivo con el nombre.');
        header('Location: /modules/Informes_Quincenales');
        exit();
    } else {


    $usuario = $_POST['userid'];
	$numeroDePDF = $_POST['num'];
	$descripcion = $_POST['descripcion'];
	$date = date('Y-m-d H:i:s');
	$status="En revisión";
	$mensaje="Sin comentarios";
	$evidencia="";
	$name_not=$_SESSION['name_user'];
	$status_not="revisar";
	$mensaje_not="ha subido a Informes Quincenales el documento: ";
	$doctype= $_POST['selectdoctype'];



	$sql_not="INSERT INTO notify (user, name, mensaje, nombrepdf, estado) VALUES ('$usuario','$name_not','$mensaje_not','$archivopdf','$status_not')";
	$result_not = $conexion->query($sql_not);

	$sql = "INSERT INTO infoq (user, num, archivopdf, descripcion, created_at, updated_at, estado, message, evidencepdf,doc_type) VALUES ('$usuario', '$numeroDePDF', '$archivopdf', '$descripcion', '$date', '$date','$status', '$mensaje', '$evidencia','$doctype')";
	$resultado = $conexion->query($sql);
    $id = $_SESSION["user_id"];
    echo "Mi id es: " . $id;

	if($_FILES["archivo"]["error"]>0){     
		
		Error ("Error al cargar el archivo");
	}else{
		$permitidos= array("application/pdf"); //Solo recibe pdf
		$limite_kb=4000;
		if(in_array($_FILES["archivo"]["type"],$permitidos) && $_FILES["archivo"]["size"]<=$limite_kb*1024){
			$ruta = 'informesquincenalespdf/'. $id . '/'; 
			$archivo=$ruta . $_FILES["archivo"]["name"];
			if(!file_exists($ruta)){  
				mkdir($ruta);
			}
			if(!file_exists($archivo)){
				$resultado=@move_uploaded_file($_FILES["archivo"]["tmp_name"],$archivo); 
				if($resultado){

                    Info ("Archivo guardado correctamente");

				}else{
                    
                    Error ("Error al guardar el archivo");

				}

			}else{

                Info ("El archivo ya existe");
			}
		}else{

			Error ("Archivo no permitido, excede el tamaño");

		}
	}
        header('Location: /modules/Informes_Quincenales');
        exit();
}

?>
