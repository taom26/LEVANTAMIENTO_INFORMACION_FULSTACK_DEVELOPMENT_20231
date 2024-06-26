<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

function unique_id($l = 10)
{
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
}


$id_generate = 'stdt-' . unique_id(5);

?>
<div class="form-data">
    <div class="head">
        <h1 class="titulo">Agregar</h1>
    </div>
    <div class="body">
        <form name="form-add-students" action="insert.php" method="POST" autocomplete="off" autocapitalize="on">
            <div class="wrap">
                <div class="first">
                    <label for="txtuserid" class="label">Usuario</label>
                    <input id="txtuserid" class="text" style=" display: none;" type="text" name="txtuserid"
                        value="<?php echo $id_generate; ?>" maxlength="50" required />
                    <input class="text" type="text" name="txt" value="<?php echo $id_generate; ?>" required disabled />

                    <label for="txtusername" class="label">Nombres</label>
                    <input id="txtusername" class="text" type="text" name="txtname" value="" placeholder="Nombre"
                        maxlength="30" required autofocus />
                    <label for="txtusersurnames" class="label">Apellidos</label>
                    <input id="txtusersurnames" class="text" type="text" name="txtsurnames" placeholder="Apellidos"
                        value="" maxlength="60" required />
                    <label for="txtuseremail" class="label">Correo Institucional</label>
                    <input id="txtuseremail" class="text" type="text" name="txtuseremail" value=""
                        placeholder="ejemplo@email.com" maxlength="200" required />

                    <label for="selectsede" class="label">Sede</label>
                    <select id="selectsede" class="select" name="selectSede" required>
                        <option value="">Seleccione</option>
                        <option value="matriz">Matriz</option>
                        <option value="latacunga">Latacunga</option>
                        <option value="stodomingo">Sto. Domingo</option>
                    </select>
                    <label for="selectuserdocumentation" class="label">Documentación</label>
                    <select id="selectuserdocumentation" class="select" name="selectDocumentation" required>
                        <option value="">Seleccione</option>
                        <option value="REPROBADO">REPROBADO</option>
                        <option value="EN PROCESO">EN PROCESO</option>
                        <option value="APROBADO">APROBADO</option>
                    </select>

                    <label for="selectuserestado" class="label">Estado</label>
                    <select id="selectuserestado" class="select" name="selectEstado" required>
                        <option value="">Seleccione</option>
                        <option value="activo">Activo</option>
                        <option value="en_proceso">En proceso</option>
                        <option value="finalizado">Finalizado</option>
                    </select>
                    <label for="selectuserdepartamento" class="label">Departamento</label>
                    <select id="selectuserdepartamento" class="select" name="selectDepartamento" required>
                        <option value="">Seleccione</option>
                        <?php
                        $resp = "SELECT id_department, name FROM department";

                        if ($resultado = $conexion->query($resp)) {
                            while ($row = mysqli_fetch_array($resultado)) {
                                echo
                                '
                                    <option value="' . $row['id_department'] . '">' . $row['name'] . '</option>
								';
                            }
                        }
                        ?>
                    </select>

                </div>
                <div class="last">
                    <label for="txtusercedula" class="label">Cédula</label>
                    <input id="txtusercedula" class="text" type="text" name="txtcedula" value=""
                        placeholder="Cédula de Identidad" pattern="[0-9]{10}" maxlength="10" required />
                    <label for="txtuserpass" class="label">Contraseña</label>
                    <input id="txtuserpass" class="text" type="password" name="txtpass" value="" placeholder="XXXXXXXXX"
                        pattern="[A-Za-z0-9]{8}" maxlength="8" required />
                    <label for="txtuserid" class="label">ID</label>
                    <input id="txtuserid" class="text" type="text" name="txtid" value="" placeholder="L00XXXXXXX"
                        pattern="[A-Za-z0-9]{9}" maxlength="9" onkeyup="this.value = this.value.toUpperCase()"
                        required />
                    <label for="txtuserphone" class="label">Número de teléfono</label>
                    <input id="txtuserphone" class="text" type="text" name="txtphone" value="" placeholder="09999XXXXX"
                        pattern="[0-9]{10}" title="Ingresa un número de teléfono válido." maxlength="10" required />
                    <label for="selectuserjerarquia" class="label">Jerarquia</label>
                    <select id="selectuserjerarquia" class="select" name="selectJerarquia" required>
                        <option value="">Seleccione</option>
                        <option value="LIDER">LIDER</option>
                        <option value="COLIDER">COLIDER</option>
                        <option value="APOYO1">APOYO 1</option>
                        <option value="APOYO2">APOYO 2</option>
                        <option value="APOYO3">APOYO 3</option>
                        <option value="APOYO4">APOYO 4</option>
                        <option value="APOYO5">APOYO 5</option>
                        <option value="APOYO6">APOYO 6</option>
                        <option value="APOYO7">APOYO 7</option>
                        <option value="APOYO8">APOYO 8</option>
                    </select>

                    <label for="selectuserjornada" class="label">Jornada</label>
                    <select id="selectuserjornada" class="select" name="selectJornada" required>
                        <option value="">Seleccione</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Otra">Otra</option>
                    </select>

                    <label for="txtuseraddress" class="label">Domicilio</label>
                    <input id="txtuseraddress" class="text" type="text" name="txtaddress" value=""
                        placeholder="Domicilio" maxlength="200" required />

                    <label for="selectusercareers" class="label">Carrera</label>
                    <select id="selectusercareers" class="select" name="selectCareer" required>
                        <option value="">Seleccione</option>
                        <?php
                        $sql = "SELECT career, name FROM careers";

                        if ($result = $conexion->query($sql)) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo
                                    '
										<option value="' . $row['career'] . '">' . $row['name'] . '</option>
								';
                            }
                        }
                        ?>
                    </select>
                </div>

                    <?php
// Función para calcular la fecha de salida
function calcularFechaSalida($fechaAdmision, $horasRequeridas)
{
    // Convertir la fecha de admisión en un objeto DateTime
    $fecha = new DateTime($fechaAdmision);

    // Inicializar un contador de horas y días
    $horasAcumuladas = 0;
    $diasAcumulados = 0;

    // Bucle para sumar horas hasta alcanzar el requisito
    while ($horasAcumuladas < $horasRequeridas) {
        // Verificar si el día actual es un fin de semana (sábado o domingo)
        if ($fecha->format('N') >= 6) {
            $fecha->modify('+1 day'); // Saltar al siguiente día
            continue;
        }

        // Agregar 3 horas al contador de horas
        $horasAcumuladas += 3;

        // Verificar si se ha alcanzado el requisito de horas
        if ($horasAcumuladas >= $horasRequeridas) {
            break;
        }

        // Saltar al siguiente día
        $fecha->modify('+1 day');
        $diasAcumulados++;
    }

    // Devolver la fecha estimada de salida
    return $fecha->format('Y-m-d');
}

$fechaAdmision = ''; // Inicializa la fecha de admisión
$horasRequeridas = 0; // Inicializa las horas requeridas

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dateadmission']) && isset($_POST['txthreq'])) {
    // Verifica si el formulario se ha enviado y si se proporcionó la fecha de admisión y las horas requeridas
    $fechaAdmision = $_POST['dateadmission'];
    $horasRequeridas = $_POST['txthreq'];

    // Calcular la fecha de salida
    $fechaSalida = calcularFechaSalida($fechaAdmision, $horasRequeridas);
}

?>
<div>
<label for="dateuseradmission" class="label">Fecha de admisión</label>
<input id="dateuseradmission" class="date" type="date" name="dateadmission" value="<?php echo date('Y-m-d'); ?>" required />
<label for="txthreq" class="label">Horas Requeridas</label>
<input id="txthreq" type="text" name="txthreq" value="0" min="0" required />

<label for="dateuserout" class="label">Fecha estimada de salida</label>
<input id="dateuserout" class="date" type="date" name="datefinish" value="" readonly required />



</div>
                 <!--
                    <div class="last">
                    <label class="label" for="txthours">
                        <label for="txttotalhours_hidden" class="label" placeholder="Suma de las horas">Horas de
                            Vinculación</label>
                        <input class="text" type="hidden" name="txttotalhours_hidden" id="txttotalhours_hidden"
                            value="">
                        Horas
                        <span>
                            <input id="txthours" type="text" name="txthours" value="0" min="0">
                            <button id="addHoursBtn" class="btn"
                                style="background: none; border: none; width: 25px; height: 25px;">
                                <i class="fas fa-plus-circle" style="color: white;"></i>
                            </button>
                        </span>
                    </label>
                    <br>
                    <label class="label" for="txttotalhours">
                        Total de Horas
                        <span>
                            <input id="txttotalhours" type="text" name="txttotalhours" value="0" readonly>
                            <button id="resetHoursBtn" class="btn"
                                style="background: none; border: none; width: 25px; height: 25px;">
                                <i class="fas fa-redo-alt" style="color: white;"></i>
                            </button>
                        </span>
                    </label>

                </div>
                  -->
                <div>
                <div class="description">
                        <label for="txtuserhours" class="label">Seleccione sus Horarios</label>
                        <input id="txtuserhours" class="text" type="hidden" name="txtuserhours" value=""
                        placeholder="Seleccione el horario" maxlength="20000" data-expandable />
                        <div class="hour-picker">
                            <div>
                                <label for="txtuserhours_start" class="text">Hora de entrada:</label>
                                <input id="txtuserhours_start" class="hour-input" type="time" name="txtuserhours_start">
                            </div>
                            <div>
                              <label for="txtuserhours_end" class="text">Hora de salida:</label>
                              <input id="txtuserhours_end" class="hour-input" type="time" name="txtuserhours_end">
                            <!-- <button id="addHourBtn" class="btn icon"><i
                                class="fas fa-plus-circle fa-lg fa-spin"></i></button> -->
                            </div>
                            </div>

                    </div>

                    <div class="label" id="hourListContainer">
                        <br>
                        <ul id="hourList"></ul>
                    </div>
                </div>


                <div class="description">
                    <label for="txtuserdates" class="label">Asistencia</label>
                    <input id="txtuserdates" class="textarea" type="text" name="txtuserdates" value=""
                        placeholder="Seleccione fechas" maxlength="20000" data-expandable />
                    <button id="addBtn" class="btn icon"><i class="fas fa-plus-circle fa-lg fa-spin"></i></button>
                </div>
                <div class="label" id="dateListContainer">
                    <ul id="dateList"></ul>
                </div>
            </div>
            
            <button id="btnSave" class="btn icon" type="submit">save</button>
        </form>
    </div>
</div>
<div class="content-aside">
    <?php
    include_once "../sections/options-disabled.php";
    ?>
</div>

<script>
    $(document).ready(function () {
        $("#txtuserdates").datepicker({
            dateFormat: 'yy-mm-dd',
            numberOfMonths: 1,
            onSelect: function (selectedDate) {
                $(this).val(selectedDate);
            }
        });

        // Agregamos cada fecha seleccionada a la lista
        $("#addBtn").click(function (event) {
            event.preventDefault();
            var date = $("#txtuserdates").val();
            if (date != "") {
                $("#dateList").append("<li>" + date + " <button class='removeBtn'><i class='fas fa-times-circle fa-lg fa-spin'></i></button></li>");
                $("#txtuserdates").val("");
            }
        });

        // Eliminamos la fecha seleccionada de la lista
        $(document).on("click", ".removeBtn", function () {
            $(this).parent().remove();
        });

        // Al hacer submit, guardamos la lista en la variable students_asistencia
        $("form").submit(function () {
            var dates = [];
            $("#dateList li").each(function () {
                dates.push($(this).text().replace(" Eliminar", ""));
            });
            $("#txtuserdates").val(dates.join(", "));
            return true;
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Agregamos cada horario seleccionado a la lista
        $("#addHourBtn").click(function (event) {
            event.preventDefault();
            var startHour = $("#txtuserhours_start").val();
            var endHour = $("#txtuserhours_end").val();
            if (startHour != "" && endHour != "") {
                $("#hourList").append("<li>" + startHour + " - " + endHour + " <button class='removeHourBtn'><i class='fas fa-times-circle fa-lg fa-spin'></i></button></li>");
                $("#txtuserhours").val($("#txtuserhours").val().replace(hour, ''));
                $("#txtuserhours_start").val("");
                $("#txtuserhours_end").val("");
            }
        });

        // Eliminamos el horario seleccionado de la lista
        $(document).on("click", ".removeHourBtn", function () {
            $(this).parent().remove();
            $("#txtuserhours").val($("#hourList").html());
        });

        // Al hacer submit, guardamos la lista en la variable students_horario
        $("form").submit(function () {
            var hours = [];
            $("#hourList li").each(function () {
                var hour = $(this).text().replace(" Eliminar", "");
                hour = hour.split(" - ");
                hours.push(hour[0] + "-" + hour[1]);
            });
            $("#txtuserhours").val(hours.join(", "));
            return true;
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Al hacer clic en el botón Agregar, se suman las horas ingresadas y se actualiza el campo Total de Horas
        $("#addHoursBtn").on("click", function (event) {
            event.preventDefault();
            var hours = parseInt($("#txthours").val());
            var total = parseInt($("#txttotalhours").val());
            if (!isNaN(hours)) {
                total += hours;
                $("#txttotalhours").val(total);
                $("#txthours").val(0);
            }
        });

        // Al hacer clic en el botón Reiniciar, se reinicia el campo Total de Horas
        $("#resetHoursBtn").on("click", function (event) {
            event.preventDefault();
            $("#txttotalhours").val(0);




        });
        $("form").submit(function () {
            $("#txttotalhours_hidden").val($("#txttotalhours").val());
            return true;
        });

    });
</script>


<script>
    // Función para calcular la fecha de salida
    function calcularFechaSalida() {
        var fechaAdmision = new Date(document.getElementById("dateuseradmission").value);
        var horasRequeridas = parseInt(document.getElementById("txthreq").value); // Obtiene las horas requeridas
        
        // Bucle para sumar horas laborables hasta alcanzar el requisito
        while (horasRequeridas > 0) {
            fechaAdmision.setDate(fechaAdmision.getDate() + 1);
            
            // Verificar si el día actual no es sábado (6) ni domingo (0)
            if (fechaAdmision.getDay() !== 6 && fechaAdmision.getDay() !== 0) {
                horasRequeridas -= 3;
            }
        }
        
        // Formatear la fecha de salida
        var year = fechaAdmision.getFullYear();
        var month = (fechaAdmision.getMonth() + 1).toString().padStart(2, '0');
        var day = fechaAdmision.getDate().toString().padStart(2, '0');
        var fechaSalida = year + '-' + month + '-' + day;
        
        // Actualizar el campo de fecha de salida
        document.getElementById("dateuserout").value = fechaSalida;
    }
    
    // Escuchar cambios en la fecha de admisión
    document.getElementById("txthreq").addEventListener("input", calcularFechaSalida);
</script>




<script src="/js/modules/students.js" type="text/javascript"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-0sCz7O9XlHUBlTepQg2tL/j/ZtMInzGRBfKv2n/bGEB1MkXkXpy0eMHvG+vcnBfACpJZl+S6Z5p5r5L5Hy5U2Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />



<?php


# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

?>