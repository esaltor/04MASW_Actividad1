<div class="row">
    <div class="col-12">
        <h1>Crear Idioma</h1>
    </div>
    <div class="col-12">
        <form name="create_language" action="" method="POST">
            <div class="mb-3">
                <label for="languageName" class="form-label">Nombre idioma</label>
                <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="isoCode" class="form-label">Código ISO</label>
                <input id="isoCode" name="isoCode" type="text" placeholder="Introduce el código ISO del idioma" class="form-control" required>
            </div>
            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
        </form>
    </div>
</div>
<?php
    $sendData = false;
    $languageCreated = false;

    if(isset($_POST['createBtn'])) {
        $sendData = true;
    }
    
    if($sendData) {
        if(isset($_POST['languageName']) && isset($_POST['isoCode'])) {
            $languageCreated = storeLanguage($_POST['languageName'], $_POST['isoCode']);
        }
    }

    if(!$sendData) {
?>
<?php
    } else {
        if ($languageCreated) {
            ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Idioma creado correctamente.<br><a href="index.php?controller=language&action=list">Volver al listado de idiomas</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El idioma no se ha creado correctamente.<br><a href="index.php?controller=language&action=create">Volver a intentarlo</a>
                </div>
            </div>
            <?php
        }
    }
?>
