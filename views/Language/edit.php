<div class="container">
    <?php
        $idLanguage = $_GET['id'];
        $languageObject = getLanguageData($idLanguage);
    ?>
    <div class="row">
        <div class="col-12">
            <h1>Editar Idioma</h1>
        </div>
        <div class="col-12">
            <form name="edit_language" action="" method="POST">
                <div class="mb-3">
                    <label for="languageName" class="form-label">Nombre idioma</label>
                    <input id="languageName" name="languageName" type="text" placeholder="Introduce el nombre del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getNombre(); ?>">
                    <label for="languageIsoCode" class="form-label">Código ISO</label>
                    <input id="languageIsoCode" name="languageIsoCode" type="text" placeholder="Introduce el código ISO del idioma" class="form-control" required value="<?php if(isset($languageObject)) echo $languageObject->getIsoCode(); ?>">
                    <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
            </form>
        </div>
    </div>
    <?php
        $sendData = false;
        $languageEdited = false;

        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }

        if($sendData) {
            if(isset($_POST['languageName'])) {
                $languageEdited = updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['languageIsoCode']);
            }
        }
        
        if(!$sendData) {
            ?>
            <?php
        } else {
            if($languageEdited) {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Idioma editado correctamente.<br><a href="index.php?controller=language&action=list">Volver al listado de idiomas</a>
                    </div>
                </div>
                <?php
            }
            else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        El idioma no se ha editado correctamente.<br><a href="index.php?controller=language&action=edit&id=<?php echo $idLanguage; ?>">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>