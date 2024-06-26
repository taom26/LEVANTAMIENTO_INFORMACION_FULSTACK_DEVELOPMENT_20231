<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$_POST['txtuserid'] = trim($_POST['txtuserid']);
$passhash = hash("SHA256", (trim($_POST['txtpass'])));

if (empty($_POST['txtuserid'])) {
	header('Location: /');
	exit();
}
if ($_POST['txtuserid'] == '') {
	Error('Ingrese un ID correcto.');
	header('Location: /modules/teachers');
	exit();
}

$sql = "SELECT * FROM teachers WHERE user = '" . $_POST['txtuserid'] . "'|| cedula = '" . $_POST['txtcedula'] . "'";

if ($result = $conexion->query($sql)) {
	if ($row = mysqli_fetch_array($result)) {
		Error('Este Usuario ya existe, favor validar con su numero de cédula.');
		header('Location: /modules/teachers');
		exit();
	} else {
		$date = date('Y-m-d H:i:s');

		$sql_insert_user = "INSERT INTO users(user, name, surnames, email, pass, permissions, rol, image, created_at) VALUES('" . trim($_POST['txtuserid']) . "','" . trim($_POST['txtname']) . "', '" . trim($_POST['txtsurnames']) . "', '" . trim($_POST['txtemail']) . "', '" . $passhash . "', 'editor', 'teacher', 'user.png','" . $date . "')";

		if (mysqli_query($conexion, $sql_insert_user)) {
			$sql_insert_teacher = "INSERT INTO teachers(user, name, surnames, cedula, pass, id, gender, date_of_birth, phone, address, level_studies, email, career, created_at) VALUES ('" . trim($_POST['txtuserid']) . "', '" . trim($_POST['txtname']) . "', '" . trim($_POST['txtsurnames']) . "', '" . trim($_POST['txtcedula']) . "', '" . $passhash . "','" . trim($_POST['txtid']) . "', '" . trim($_POST['selectgender']) . "', '" . trim($_POST['dateofbirth']) . "', '" . trim($_POST['txtphone']) . "', '" . trim($_POST['txtaddress']) . "', '" . trim($_POST['selectlevelstudies']) . "', '" . trim($_POST['txtemail']) . "', '" . trim($_POST['selectCareer']) . "', '" . $date . "')";

			if (mysqli_query($conexion, $sql_insert_teacher)) {
				$email = $_POST['txtemail'];
				if (empty($email)) {
					Info('Error al enviar el correo');
				} else {
					include_once '../email/mail.php';
					Info('Exito al guardar, Correo enviado correctamente.');
				}
			} else {
				$sql_delete_users = "DELETE FROM users WHERE user = '" . trim($_POST['txtuserid']) . "'";

				if (mysqli_query($conexion, $sql_delete_users)) {
					Error('Error al guardar.');
				}
			}
		} else {
			Error('Error al guardar.');
		}
		header('Location: /modules/teachers');
		exit();
	}
}





# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠
