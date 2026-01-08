<div class="btn btn-group" role="group" aria-label="Series">
    <?php if (isset($series)) { ?>
        <a class="btn btn-success" href="index.php?controller=series&action=edit&id=<?php echo $series->getId();?>">Editar</a>
        <form name="delete_series" action="index.php?controller=series&action=delete" method="POST" style="...">
            <input type="hidden" name="seriesId" value="<?php echo $series->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $seriesDeleted = false;
    $hasSeriesId = isset($_POST['seriesId']);

    if ($hasSeriesId) {
        $idSeries = (int) $_POST['seriesId'];
        $seriesDeleted = deleteSeries($idSeries);
    }
?>

<?php if (!$hasSeriesId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador de la serie.<br><a href="index.php?controller=series&action=list">Volver al listado de series.</a>
        </div>
    </div>
<?php } elseif ($seriesDeleted) { ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Serie borrada correctamente.<br><a href="index.php?controller=series&action=list">Volver al listado de series.</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            La serie no se ha borrado correctamente.<br><a href="index.php?controller=series&action=list">Volver a intentarlo.</a>
        </div>
    </div>
<?php } ?>