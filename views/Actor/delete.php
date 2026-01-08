<div class="btn btn-group" role="group" aria-label="Actor">
    <?php if (isset($actor)) { ?>
        <a class="btn btn-success" href="index.php?controller=actor&action=edit&id=<?php echo $actor->getId();?>">Editar</a>
        <form name="actor" action="index.php?controller=actor&action=delete" method="POST" style="...">
            <input type="hidden" name="actorId" value="<?php echo $actor->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $actorDeleted = false;
    $hasActorId = isset($_POST['actorId']);

    if ($hasActorId) {
        $idActor = (int) $_POST['actorId'];
        $actorDeleted = deleteActor($idActor);
    }
?>

<?php if (!$hasActorId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del actor.<br><a href="index.php?controller=actor&action=list">Volver al listado de actores.</a>
        </div>
    </div>
<?php } elseif ($actorDeleted) { ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Actor borrado correctamente.<br><a href="index.php?controller=actor&action=list">Volver al listado de actores.</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            El actor no se ha borrado correctamente.<br><a href="index.php?controller=actor&action=list">Volver a intentarlo.</a>
        </div>
    </div>
<?php } ?>