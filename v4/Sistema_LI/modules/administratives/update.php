<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin.php');

$_POST['txtuserid'] = trim($_POST['txtuserid']);

if (empty($_POST['txtuserid'])) {
	header('Location: /');
	exit();
}
if ($_POST['txtuserid'] == '') {
	Error('Ingrese un ID correcto.');
	header('Location: /modules/administratives');
	exit();
}

//Conexión con la base de datos para actualizar información de un usuario específico existente en la base de datos
$sql = "SELECT * FROM administratives WHERE user = '" . $_POST['txtuserid'] . "'";

if ($result = $conexion->query($sql)) {
	if ($row = mysqli_fetch_array($result)) {
		$date = date('Y-m-d H:i:s');
		
		if (empty($_POST['txtpass'])) {
			$sql_update = "UPDATE administratives SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) . "', id = '" . trim($_POST['txtid']) . "', sede = '" . trim($_POST['selectSede']) . "', cedula = '" . trim($_POST['txtcedula']) . "', celular = '" . trim($_POST['txtcelular']) . "', date_of_birth = '" . trim($_POST['dateofbirth']) . "',carrer = '" . trim($_POST['selectCareer']) . "', email = '" . trim($_POST['txtemail']) . "', updated_at = '" . $date . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";

			if (mysqli_query($conexion, $sql_update))
				$sql_update = "UPDATE users SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) . "', email = '" . trim($_POST['txtemail']) . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";

			if (mysqli_query($conexion, $sql_update)) {
				Info('administratives actualizado.');
			} else {
				Error('Error al actualizar.');
			}
		} else {
			$passhash = hash("SHA256",(trim($_POST['txtpass'])));		
			$sql_update = "UPDATE administratives SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) . "', id = '" . trim($_POST['txtid']) . "', sede = '" . trim($_POST['selectSede']) . "', cedula = '" . trim($_POST['txtcedula']) . "', celular = '" . trim($_POST['txtcelular']) . "', pass = '" . $passhash . "', date_of_birth = '" . trim($_POST['dateofbirth']) . "',carrer = '" . trim($_POST['selectCareer']) . "', email = '" . trim($_POST['txtemail']) . "', updated_at = '" . $date . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";

			if (mysqli_query($conexion, $sql_update))
				$sql_update = "UPDATE users SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) . "', email = '" . trim($_POST['txtemail']) . "', pass = '" . $passhash . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";

			if (mysqli_query($conexion, $sql_update)) {
				Info('administratives actualizado.');
			} else {
				Error('Error al actualizar.');
			}
		
		}

		header('Location: /modules/administratives');
		exit();
	} else {
		Error('Este ID de administratives no existe.');
		header('Location: /modules/administratives');
		exit();
	}
}



# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

