<div class="btn btn-group" role="group" aria-label="Language">
    <?php if (isset($language)) { ?>
        <a class="btn btn-success" href="index.php?controller=language&action=edit&id=<?php echo $language->getId();?>">Editar</a>
        <form name="delete_language" action="index.php?controller=language&action=delete" method="POST" style="...">
            <input type="hidden" name="languageId" value="<?php echo $language->getId();?>" />
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
    <?php } ?>
</div>

<?php
    $languageDeleted = false;
    $hasLanguageId = isset($_POST['languageId']);

    if ($hasLanguageId) {
        $idLanguage = (int) $_POST['languageId'];
        $languageDeleted = deleteLanguage($idLanguage);
    }
?>

<?php if (!$hasLanguageId) { ?>
    <div class="row">
        <div class="alert alert-warning" role="alert">
            No se ha recibido el identificador del idioma.<br><a href="index.php?controller=language&action=list">Volver al listado de idiomas.</a>
        </div>
    </div>
<?php } elseif ($languageDeleted) { ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Idioma borrado correctamente.<br><a href="index.php?controller=language&action=list">Volver al listado de idiomas.</a>
        </div>
    </div>
<?php } else { ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            El idioma no se ha borrado correctamente.<br><a href="index.php?controller=language&action=list">Volver a intentarlo.</a>
        </div>
    </div>
<?php } ?>