<div class="container">
    <?php
        $idDirector = $_GET['id'];
        $directorObject = getDirectorData($idDirector);
    ?>
    <div class="row">
        <div class="col-12">
            <h1>Editar director</h1>
        </div>
        <div class="col-12">
            <form name="edit_director" action="" method="POST">
                <div class="mb-3">
                    <label for="directorName" class="form-label">Nombre director</label>
                    <input id="directorName" name="directorName" type="text" placeholder="Introduce el nombre del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getName(); ?>">
                    <label for="directorSurnames" class="form-label">Apellidos</label>
                    <input id="directorSurnames" name="directorSurnames" type="text" placeholder="Introduce los apellidos del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getSurnames(); ?>">
                    <label for="directorBirthdate" class="form-label">Fecha de nacimiento</label>
                    <input id="directorBirthdate" name="directorBirthdate" type="date" placeholder="Introduce la fecha de nacimiento del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getBirthdate(); ?>">
                    <label for="directorNationality" class="form-label">Nacionalidad</label>
                <input id="directorNationality" name="directorNationality" type="text" placeholder="Introduce la nacionalidad del director" class="form-control" required value="<?php if(isset($directorObject)) echo $directorObject->getNationality(); ?>">
                    <input type="hidden" name="directorId" value="<?php echo $idDirector; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
            </form>
        </div>
    </div>
    <?php
        $sendData = false;
        $directorEdited = false;

        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }

        if($sendData) {
            if (
                isset($_POST['directorName']) &&
                isset($_POST['directorSurnames']) &&
                isset($_POST['directorBirthdate']) &&
                isset($_POST['directorNationality'])
            ) {
                $directorEdited = updateDirector($_POST['directorId'], $_POST['directorName'], $_POST['directorSurnames'], $_POST['directorBirthdate'], $_POST['directorNationality']);
            }
        }
        
        if(!$sendData) {
            ?>
            <?php
        } else {
            if($directorEdited) {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Director editado correctamente.<br><a href="index.php?controller=director&action=list">Volver al listado de directores</a>
                    </div>
                </div>
                <?php
            }
            else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El director no se ha editado correctamente.<br><a href="index.php?controller=director&action=edit&id=<?php echo $idDirector; ?>">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>
