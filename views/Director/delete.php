<div class="btn btn-group" role="group" aria-label="Director">
    <?php if (isset($director)) { ?>
        <a class="btn btn-success" href="index.php?controller=director&action=edit&id=<?php echo $director->getId();?>">Editar</a>
        <form name="delete_director" action="index.php?controller=director&action=delete" method="POST">
            <input type="hidden" name="directorId" value="<?php echo $director->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $directorDeleted = false;
    $hasDirectorId = isset($_POST['directorId']);
    $result = null;

    if ($hasDirectorId) {
        $result = deleteDirector((int)$_POST['directorId']);
    }
?>

<?php if (!$hasDirectorId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del director.<br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
        </div>
    </div>
<?php } elseif ($result === 'deleted') { ?>
    <div class="alert alert-success">
        Director borrado correctamente.
        <br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
    </div>

<?php } elseif ($result === 'has_series') { ?>
    <div class="alert alert-danger">
        No se puede borrar el director porque tiene series asociadas.
        <br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
    </div>

<?php } elseif ($result === 'not_found') { ?>
    <div class="alert alert-warning">
        El director no existe.
        <br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
    </div>

<?php } elseif ($result === 'error') { ?>
    <div class="alert alert-danger">
        Se ha producido un error al intentar borrar el director.
        <br><a href="index.php?controller=director&action=list">Volver a intentarlo.</a>
    </div>
<?php } ?>
