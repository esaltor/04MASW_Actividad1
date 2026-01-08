<div class="row">
    <div class="col-12">
        <h1>Crear actor</h1>
    </div>
    <div class="col-12">
        <form name="create_actor" action="" method="POST">
            <div class="mb-3">
                <label for="actorName" class="form-label">Nombre actor</label>
                <input id="actorName" name="actorName" type="text" placeholder="Introduce el nombre del actor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="actorSurnames" class="form-label">Apellidos actor</label>
                <input id="actorSurnames" name="actorSurnames" type="text" placeholder="Introduce los apellidos del actor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="actorBirthDate" class="form-label">Fecha de nacimiento actor</label>
                <input id="actorBirthDate" name="actorBirthDate" type="date" placeholder="Introduce la fecha de nacimiento del actor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="actorNationality" class="form-label">Nacionalidad actor</label>
                <input id="actorNationality" name="actorNationality" type="text" placeholder="Introduce la nacionalidad del actor" class="form-control" required>
            </div>
            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
        </form>
    </div>
</div>
<?php
    $sendData = false;
    $actorCreated = false;

    if(isset($_POST['createBtn'])) {
        $sendData = true;
    }
    
    if($sendData) {
        if(isset($_POST['actorName']) && isset($_POST['actorSurnames']) && isset($_POST['actorBirthDate']) && isset($_POST['actorNationality'])) {
            $actorCreated = storeActor($_POST['actorName'], $_POST['actorSurnames'], $_POST['actorBirthDate'], $_POST['actorNationality']);
        }
    }

    if(!$sendData) {
?>
<?php
    } else {
        if ($actorCreated) {
            ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Actor creado correctamente.<br><a href="index.php?controller=actor&action=list">Volver al listado de actores</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El actor no se ha creado correctamente.<br><a href="index.php?controller=actor&action=create">Volver a intentarlo</a>
                </div>
            </div>
            <?php
        }
    }
?>
