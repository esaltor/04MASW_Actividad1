<div class="btn btn-group" role="group" aria-label="Platform">
    <?php if (isset($platform)) { ?>
        <a class="btn btn-success" href="index.php?controller=platform&action=edit&id=<?php echo $platform->getId();?>">Editar</a>
        <form name="delete_platform" action="index.php?controller=platform&action=delete" method="POST" style="...">
            <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $platformDeleted = false;
    $hasPlatformId = isset($_POST['platformId']);

    if ($hasPlatformId) {
        $idPlatform = (int) $_POST['platformId'];
        $platformDeleted = deletePlatform($idPlatform);
    }
?>

<?php if (!$hasPlatformId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador de la plataforma.<br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
        </div>
    </div>
<?php } elseif ($platformDeleted) { ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Plataforma borrada correctamente.<br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            La plataforma no se ha borrado correctamente.<br><a href="index.php?controller=platform&action=list">Volver a intentarlo.</a>
        </div>
    </div>
<?php } ?>
