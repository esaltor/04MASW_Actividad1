<div class="container">
    <?php
        $idActor = $_GET['id'];
        $actorObject = getActorData($idActor);
    ?>
    <div class="row">
        <div class="col-12">
            <h1>Editar actor</h1>
        </div>
        <div class="col-12">
            <form name="edit_actor" action="" method="POST">
                <div class="mb-3">
                    <label for="actorName" class="form-label">Nombre actor</label>
                    <input id="actorName" name="actorName" type="text" placeholder="Introduce el nombre del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getName(); ?>">
                    <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                </div>
                <div class="mb-3">
                    <label for="actorSurnames" class="form-label">Apellidos actor</label>
                    <input id="actorSurnames" name="actorSurnames" type="text" placeholder="Introduce los apellidos del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getSurnames(); ?>">
                    <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                </div>
                <div class="mb-3">
                    <label for="actorBirthDate" class="form-label">Fecha de nacimiento actor</label>
                    <input id="actorBirthDate" name="actorBirthDate" type="text" placeholder="Introduce la fecha de nacimiento del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getBirthDate(); ?>">
                    <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                </div>
                <div class="mb-3">
                    <label for="actorNationality" class="form-label">Nacionalidad actor</label>
                    <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required value="<?php if(isset($actorObject)) echo $actorObject->getNationality(); ?>">
                    <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
            </form>
        </div>
    </div>
    <?php
        $sendData = false;
        $actorEdited = false;

        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }

        if($sendData) {
            if(isset($_POST['actorName']) && isset($_POST['actorSurnames']) && isset($_POST['actorBirthDate']) && isset($_POST['actorNationality'])) {
                $actorEdited = updateActor($_POST['actorId'], $_POST['actorName'], $_POST['actorSurnames'], $_POST['actorBirthDate'], $_POST['actorNationality']);
            }
        }
        
        if(!$sendData) {
            ?>
            <?php
        } else {
            if($actorEdited) {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Actor editado correctamente.<br><a href="index.php?controller=actor&action=list">Volver al listado de actores</a>
                    </div>
                </div>
                <?php
            }
            else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El actor no se ha editado correctamente.<br><a href="index.php?controller=actor&action=edit&id=<?php echo $idActor; ?>">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>