<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin.php');

$_POST['txtuserid'] = trim($_POST['txtuserid']);
$passhash = hash("SHA256", (trim($_POST['txtpass'])));

if (empty($_POST['txtuserid'])) {
	header('Location: /');
	exit();
}
if ($_POST['txtuserid'] == '') {
	Error('Ingrese un ID correcto.');
	header('Location: /modules/administratives');
	exit();
}


//Conexión con la base de datos para insertar información de un usuario específico en la base de datos
$sql = "SELECT * FROM administratives WHERE user = '" . $_POST['txtuserid'] . "'";

if ($result = $conexion->query($sql)) {
	if ($row = mysqli_fetch_array($result)) {
		Error('Este ID ya está en uso. Elige otro.');
		header('Location: /modules/administratives');
		exit();
	} else {
		$date = date('Y-m-d H:i:s');

		$sql_insert_user = "INSERT INTO users(user, name, surnames, email, pass, permissions, rol, image, created_at) VALUES('" . trim($_POST['txtuserid']) . "','" . trim($_POST['txtname']) . "', '" . trim($_POST['txtsurnames']) . "', '" . trim($_POST['txtemail']) . "', '" . $passhash . "', 'admin', 'admin', 'user.png','" . $date . "')";

		if (mysqli_query($conexion, $sql_insert_user)) {
			$sql_insert_administratives = "INSERT INTO administratives(user, name, surnames, date_of_birth, cedula, id, carrer, sede, email, celular, pass, created_at) VALUES('" . trim($_POST['txtuserid']) . "', '" . trim($_POST['txtname']) . "', '" . trim($_POST['txtsurnames']) . "', '" . trim($_POST['dateofbirth']) . "', '" . trim($_POST['txtcedula']) . "', '" . trim($_POST['txtid']) . "', '" . trim($_POST['selectCareer']) . "', '" . trim($_POST['selectSede']) . "', '" . trim($_POST['txtemail']) . "', '" . trim($_POST['txtcelular']) . "', '" . $passhash . "', '" . $date . "')";

			if (mysqli_query($conexion, $sql_insert_administratives)) {
				$email = $_POST['txtemail'];
				if (empty($email)) {
					Info('Error al enviar el correo');
				} else {
					include_once '../email/mail.php';
					Info('Exito al guardar, Correo enviado correctamente.');
				}
			} else {
				$sql_delete_users = "DELETE FROM users WHERE user = '" . $_POST['txtuserid'] . "'";

				if (mysqli_query($conexion, $sql_delete_users)) {
					Error('Error al guardar.');
				}
			}
		} else {
			Error('Error al guardar.');
		}
		header('Location: /modules/administratives');
		exit();
	}
}




# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠
