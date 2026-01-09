<div class="btn btn-group" role="group" aria-label="Language">
    <?php if (isset($language)) { ?>
        <a class="btn btn-success" href="index.php?controller=language&action=edit&id=<?php echo $language->getId();?>">Editar</a>
        <form name="delete_language" action="index.php?controller=language&action=delete" method="POST">
            <input type="hidden" name="languageId" value="<?php echo $language->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $languageDeleted = false;
    $hasLanguageId = isset($_POST['languageId']);
    $result = null;

    if ($hasLanguageId) {
        $result = deleteLanguage((int)$_POST['languageId']);
    }
?>

<?php if (!$hasLanguageId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del idioma.<br><a href="index.php?controller=language&action=list">Volver al listado de idiomas.</a>
        </div>
    </div>
<?php } elseif ($result === 'deleted') { ?>
    <div class="alert alert-success">
        Idioma borrado correctamente.
        <br><a href="index.php?controller=language&action=list">Volver al listado de idiomas.</a>
    </div>

<?php } elseif ($result === 'not_found') { ?>
    <div class="alert alert-warning">
        El idioma no existe.
        <br><a href="index.php?controller=language&action=list">Volver al listado de idiomas.</a>
    </div>

<?php } elseif ($result === 'error') { ?>
    <div class="alert alert-danger">
        Se ha producido un error al intentar borrar el idioma.
        <br><a href="index.php?controller=language&action=list">Volver a intentarlo.</a>
    </div>
<?php } ?>