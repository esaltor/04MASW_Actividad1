<div class="btn btn-group" role="group" aria-label="Platform">
    <?php if (isset($platform)) { ?>
        <a class="btn btn-success" href="index.php?controller=platform&action=edit&id=<?php echo $platform->getId();?>">Editar</a>
        <form name="delete_platform" action="index.php?controller=platform&action=delete" method="POST">
            <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $platformDeleted = false;
    $hasPlatformId = isset($_POST['platformId']);
    $result = null;

    if ($hasPlatformId) {
        $result = deletePlatform((int)$_POST['platformId']);
    }
?>

<?php if (!$hasPlatformId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador de la plataforma.<br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
        </div>
    </div>
<?php } elseif ($result === 'deleted') { ?>
    <div class="alert alert-success">
        Plataforma borrada correctamente.
        <br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
    </div>

<?php } elseif ($result === 'has_series') { ?>
    <div class="alert alert-danger">
        No se puede borrar la plataforma porque tiene series asociadas.
        <br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
    </div>

<?php } elseif ($result === 'not_found') { ?>
    <div class="alert alert-warning">
        La plataforma no existe.
        <br><a href="index.php?controller=platform&action=list">Volver al listado de plataformas.</a>
    </div>

<?php } elseif ($result === 'error') { ?>
    <div class="alert alert-danger">
        Se ha producido un error al intentar borrar la plataforma.
        <br><a href="index.php?controller=platform&action=list">Volver a intentarlo.</a>
    </div>
<?php } ?>