<?php
include_once '../security.php';
include_once '../conexion.php';
include_once '../notif_info_msgbox.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$_POST['txtuserid'] = trim($_POST['txtuserid']);

if (empty($_POST['txtuserid'])) {
	header('Location: /');
	exit();
}
if ($_POST['txtuserid'] == '') {
	Error('Ingrese un ID correcto!!');
	header('Location: /modules/students');
	exit();
}

// Verificar si ya existe otro usuario con el mismo correo electronico
$sql_check_email = "SELECT * FROM users WHERE email = ? AND user != ?";
$stmt_check_email = $conexion->prepare($sql_check_email);
$stmt_check_email->bind_param("ss", trim($_POST['txtemailupdate']), $_POST['txtuserid']);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();

if ($result_check_email->num_rows > 0) {
    Error('Ya existe otro usuario con el mismo correo electronico.');
    header('Location: /modules/students');
    exit();
}

// aqui empieza el update de estudiante

$sql_student = "SELECT * FROM students WHERE user = '" . $_POST['txtuserid'] . "'";
$sql_user = "SELECT * FROM users WHERE user = '" . $_POST['txtuserid'] . "'";



mysqli_begin_transaction($conexion);
try {
    // Actualizar tabla studentshttp://localhost/home
    if ($result = $conexion->query($sql_student)) {
        if ($row = mysqli_fetch_array($result)) {
            $date = date('Y-m-d H:i:s');
            if (empty($_POST['txtpass'])) {
                $sql_update_student = "UPDATE students SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) ."', email = '" . trim($_POST['txtemailupdate']). "', cedula = '" . trim($_POST['txtcedula']) . "', id = '" . trim($_POST['txtid']) . "', date_of_birth = '" . trim($_POST['dateofbirth']) . "', sede = '" . trim($_POST['selectSede']) . "', phone = '" . trim($_POST['txtphone']) ."', jerarquia = '" . trim($_POST['selectJerarquia']) . "', jornada = '" . trim($_POST['selectJornada']) ."', address = '" . trim($_POST['txtaddress']) . "', career = '" . trim($_POST['selectCareer']) . "',horas = '" . trim($_POST['txttotalhours_hidden']) . "',horario = '" . trim($_POST['txtuserhours']) . "',asistencia = '" . trim($_POST['txtuserdates']) . "', documentation = '" . trim($_POST['selectDocumentation']) ."', estado = '" . trim($_POST['selectEstado']) . "', departamento = '" . trim($_POST['txtdepartamento']) . "', admission_date = '" . trim($_POST['dateadmission']) . "', updated_at = '" . $date . "', finish_date = '" . trim($_POST['datefinish']) . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";
            }else {
                $passhash = hash("SHA256",(trim($_POST['txtpass'])));
                $sql_update_student = "UPDATE students SET name = '" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) ."', email = '" . trim($_POST['txtemailupdate']). "', cedula = '" . trim($_POST['txtcedula']) . "', pass = '" . $passhash . "', id = '" . trim($_POST['txtid']) . "', date_of_birth = '" . trim($_POST['dateofbirth']) . "', sede = '" . trim($_POST['selectSede']) . "', phone = '" . trim($_POST['txtphone']) ."', jerarquia = '" . trim($_POST['selectJerarquia']) . "', jornada = '" . trim($_POST['selectJornada']) ."', address = '" . trim($_POST['txtaddress']) . "', career = '" . trim($_POST['selectCareer']) . "',horas = '" . trim($_POST['txttotalhours_hidden']) . "',horario = '" . trim($_POST['txtuserhours']) . "',asistencia = '" . trim($_POST['txtuserdates']) . "', documentation = '" . trim($_POST['selectDocumentation']) ."', estado = '" . trim($_POST['selectEstado']) . "', departamento = '" . trim($_POST['txtdepartamento']) . "', admission_date = '" . trim($_POST['dateadmission']) . "', updated_at = '" . $date . "', finish_date = '" . trim($_POST['datefinish']) . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";
            }

            if (mysqli_query($conexion, $sql_update_student)) {
                Info('Alumno actualizado.');
            } else {
                Error('Error al actualizar.');
            }
        } else {
            Error('Este ID de alumno no existe.');
        }
    }

    // Actualizar tabla users
    if ($result = $conexion->query($sql_user)) {
        if ($row = mysqli_fetch_array($result)) {
            $date = date('Y-m-d H:i:s');
            if (empty($_POST['txtpass'])) {
                $sql_update_user = "UPDATE users SET name ='" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) ."', email = '" . trim($_POST['txtemailupdate']). "', permissions = 'editor', rol = 'student', updated_at = '" . $date . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";
            } else {
                $passhash = hash("SHA256",(trim($_POST['txtpass'])));
                $sql_update_user = "UPDATE users SET name ='" . trim($_POST['txtname']) . "', surnames = '" . trim($_POST['txtsurnames']) ."', email = '" . trim($_POST['txtemailupdate']). "', pass = '" . $passhash . "', permissions = 'editor', rol = 'student', updated_at = '" . $date . "' WHERE user = '" . trim($_POST['txtuserid']) . "'";
            }
            

            if (mysqli_query($conexion, $sql_update_user)) {
                Info('Usuario actualizado.');
            } else {
                Error('Error al actualizar.');
            }
        } else {
            Error('Este ID de usuario no existe.');
        }
    }

    mysqli_commit($conexion);
} catch (Exception $e) {
    mysqli_rollback($conexion);
    Error('Error al actualizar.');
}

header('Location: /modules/students');
exit();







# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

