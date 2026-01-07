<div class="container">
    <?php
        $idPlatform = $_GET['id'];
        $platformObject = getPlatformData($idPlatform);
    ?>
    <div class="row">
        <div class="col-12">
            <h1>Editar plataforma</h1>
        </div>
        <div class="col-12">
            <form name="edit_platform" action="" method="POST">
                <div class="mb-3">
                    <label for="platformName" class="form-label">Nombre plataforma</label>
                    <input id="platformName" name="platformName" type="text" placeholder="Introduce el nombre de la plataforma" class="form-control" required value="<?php if(isset($platformObject)) echo $platformObject->getName(); ?>">
                    <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
            </form>
        </div>
    </div>
    <?php
        $sendData = false;
        $platformEdited = false;

        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }

        if($sendData) {
            if(isset($_POST['platformName'])) {
                $platformEdited = updatePlatform($_POST['platformId'], $_POST['platformName']);
            }
        }
        
        if(!$sendData) {
            ?>
            <?php
        } else {
            if($platformEdited) {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Plataforma editada correctamente.<br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas</a>
                    </div>
                </div>
                <?php
            }
            else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La plataforma no se ha editado correctamente.<br><a href="index.php?controller=platform&action=edit&id=<?php echo $idPlatform; ?>">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>
