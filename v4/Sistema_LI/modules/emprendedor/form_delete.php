<?php
require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');
?>
<div class="form-data">
    <div class="head">
        <h1 class="titulo">Atención</h1>
    </div>
    <div class="delete">
        <h1>¿Estas seguro?</h1>
        <h2>¡Se borrará de forma permanente!</h2>
        <form name="form-delete-emprendedor" action="delete.php" method="POST">
            <input style="display: none;" type="text" name="txtuserid" value="<?php echo $_POST['txtuserid']; ?>" />
            <button id="btnYesDelete" class="btn-si" type="submit" autofocus>¡Si, bórralo!</button>
        </form>
        <form action="" method="POST">
            <button id="btnNoDelete" class="btn-no" name="btn" value="form_default" type="submit">Cancelar</button>
        </form>
    </div>
</div>
<div class="content-aside">
    <?php include_once "../sections/options-disabled.php"; ?>
</div>


<?php

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

// Todos los derechos reservados © Quito - Ecuador || Estudiantes TIC's en línea || Levantamiento de Información || ESPE 2022-2023

// Ricardo Alejandro  Jaramillo Salgado, Michael Andres Espinosa Carrera, Steven Cardenas, Luis LLumiquinga

# ⚠⚠⚠ DO NOT DELETE ⚠⚠⚠

?>