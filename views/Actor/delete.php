<div class="btn btn-group" role="group" aria-label="Actor">
    <?php if (isset($actor)) { ?>
        <a class="btn btn-success" href="index.php?controller=actor&action=edit&id=<?php echo $actor->getId();?>">Editar</a>
        <form name="actor" action="index.php?controller=actor&action=delete" method="POST">
            <input type="hidden" name="actorId" value="<?php echo $actor->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $actorDeleted = false;
    $hasActorId = isset($_POST['actorId']);
    $result = null;

    if ($hasActorId) {
        $result = deleteActor((int)$_POST['actorId']);
    }
?>

<?php if (!$hasActorId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del actor.<br><a href="index.php?controller=actor&action=list">Volver al listado de actores.</a>
        </div>
    </div>
<?php } elseif ($result === 'deleted') { ?>
    <div class="alert alert-success">
        Actor borrado correctamente.
        <br><a href="index.php?controller=actor&action=list">Volver al listado de actores.</a>
    </div>

<?php } elseif ($result === 'not_found') { ?>
    <div class="alert alert-warning">
        El actor no existe.
        <br><a href="index.php?controller=actor&action=list">Volver al listado de actores.</a>
    </div>

<?php } elseif ($result === 'error') { ?>
    <div class="alert alert-danger">
        Se ha producido un error al intentar borrar el actor.
        <br><a href="index.php?controller=actor&action=list">Volver a intentarlo.</a>
    </div>
<?php } ?>