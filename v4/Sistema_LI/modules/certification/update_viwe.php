<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$_POST['txtnum'] = trim($_POST['txtnum']);

if (empty($_POST['txtnum'])) {
    header('Location: /');
    exit();
}
$id = $_SESSION['user_id'];
$date = date('Y-m-d H:i:s');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Verificar si se ha cargado un archivo
	if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
		$nombre_archivo = $_FILES["archivo"]["name"];
		$ruta_temporal = $_FILES["archivo"]["tmp_name"];

		// Define la carpeta donde deseas guardar el archivo
		$carpeta_destino = 'certificadopdf/'. $id . '/';


		// Verifica si la carpeta de destino existe y créala si no
        if (!file_exists($carpeta_destino)) {
            mkdir($carpeta_destino, 0755, true);
        }

        // Ruta completa del archivo destino
        $ruta_destino = $carpeta_destino . $nombre_archivo;

        // Si ya existe un archivo con el mismo nombre, elimínalo
        if (file_exists($ruta_destino)) {
            unlink($ruta_destino);
        }

        // Mueve el nuevo archivo temporal a la carpeta de destino
        if (move_uploaded_file($ruta_temporal, $ruta_destino)) {
            // El archivo se ha cargado exitosamente
            Info("Archivo cargado con éxito.");
            
            // Actualiza la base de datos con el nombre del archivo
            $sql_update = "UPDATE certification SET archivopdf = '" . $nombre_archivo . "', message_student = '" . trim($_POST['comentario']) . "' WHERE num = '" . trim($_POST['txtnum']) . "'";

            if (mysqli_query($conexion, $sql_update)) {
                Info('Información actualizada.');
            } else {
                Error('Error al actualizar.');
            }
        } else {
            // Hubo un error al mover el archivo
            Error("Error al cargar el archivo.");
        }
    } else {
        // No se cargó un archivo, solo actualiza la base de datos sin cambiar el archivo
        $sql_update = "UPDATE certification SET message_student = '" . trim($_POST['comentario']) . "' WHERE num = '" . trim($_POST['txtnum']) . "'";

        if (mysqli_query($conexion, $sql_update)) {
            Info('Comentario del estudiante actualizado.');
        } else {
            Error('Error al actualizar.');
        }
    }
}																		
header('Location: /modules/certification');
exit();
?>