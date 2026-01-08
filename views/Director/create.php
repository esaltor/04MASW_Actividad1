<div class="row">
    <div class="col-12">
        <h1>Crear director</h1>
    </div>
    <div class="col-12">
        <form name="create_director" action="" method="POST">
            <div class="mb-3">
                <label for="directorName" class="form-label">Nombre</label>
                <input id="directorName" name="directorName" type="text" placeholder="Introduce el nombre del director" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="directorSurnames" class="form-label">Apellidos</label>
                <input id="directorSurnames" name="directorSurnames" type="text" placeholder="Introduce los apellidos del director" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="directorBirthdate" class="form-label">Fecha de nacimiento</label>
                <input id="directorBirthdate" name="directorBirthdate" type="date" placeholder="Introduce la fecha de nacimiento del director" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="directorNationality" class="form-label">Nacionalidad</label>
                <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce la nacionalidad del director" class="form-control" required>
            </div>
            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
        </form>
    </div>
</div>
<?php
    $sendData = false;
    $directorCreated = false;

    if(isset($_POST['createBtn'])) {
        $sendData = true;
    }
    
    if($sendData) {
        if (
            isset($_POST['directorName']) &&
            isset($_POST['directorSurnames']) &&
            isset($_POST['directorBirthdate']) &&
            isset($_POST['directorNationality'])
        ) {
            $directorCreated = storeDirector($_POST['directorName'], $_POST['directorSurnames'], $_POST['directorBirthdate'], $_POST['directorNationality']);
        }
    }

    if(!$sendData) {
?>
<?php
    } else {
        if ($directorCreated) {
            ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Director creado correctamente.<br><a href="index.php?controller=director&action=list">Volver al listado de directores</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El director no se ha creado correctamente.<br><a href="index.php?controller=director&action=create">Volver a intentarlo</a>
                </div>
            </div>
            <?php
        }
    }
?>
