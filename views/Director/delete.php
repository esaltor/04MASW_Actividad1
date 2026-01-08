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

    if ($hasDirectorId) {
        $idDirector = (int) $_POST['directorId'];
        $directorDeleted = deleteDirector($idDirector);
    }
?>

<?php if (!$hasDirectorId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del director.<br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
        </div>
    </div>
<?php } elseif ($directorDeleted) { ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Director borrado correctamente.<br><a href="index.php?controller=director&action=list">Volver al listado de directores.</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            El director no se ha borrado correctamente.<br><a href="index.php?controller=director&action=list">Volver a intentarlo.</a>
        </div>
    </div>
<?php } ?>
