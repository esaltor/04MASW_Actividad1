<div class="row">
    <div class="col-12">
        <h1>Crear Serie</h1>
    </div>
    <div class="col-12">
        <form name="create_series" action="" method="POST">
            <div class="mb-3">
                <label for="seriesTitulo" class="form-label">Título</label>
                <input id="seriesTitulo" name="seriesTitulo" type="text" placeholder="Introduce el título de la serie" class="form-control" required>
            </div>

            <?php
                $platforms = listPlatforms();
            ?>

            <div class="mb-3">
                <label for="plataformaId" class="form-label">Plataforma</label>
                <select id="plataformaId" name="plataformaId" class="form-control" required>
                    <option value="">Selecciona una plataforma</option>
                    <?php foreach ($platforms as $platform): ?>
                        <option value="<?= $platform->getId() ?>"><?= $platform->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

             <?php
                #$directors = listDirectors();
             ?>


            <div class="mb-3">
                <label for="directorId" class="form-label">Director</label>
                <select id="directorId" name="directorId" class="form-control" ><!-- required>-->
                    <option value="">Selecciona un director</option>
                    <?php foreach ($directors as $director): ?>
                        <option value="<?= $director->getId() ?>"><?= $director->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="actores" class="form-label">Actores</label>
                <textarea id="actores" name="actores" placeholder="Introduce los actores de la serie" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="idiomasAudio" class="form-label">Idiomas Audio</label>
                <textarea id="idiomasAudio" name="idiomasAudio" placeholder="Introduce los idiomas de audio de la serie" class="form-control" required></textarea>
            </div>  
            <div class="mb-3">
                <label for="idiomasSubtitulos" class="form-label">Idiomas Subtítulos</label>
                <textarea id="idiomasSubtitulos" name="idiomasSubtitulos" placeholder="Introduce los idiomas de subtítulos de la serie" class="form-control" required></textarea>
            </div>
            <input type="submit" value="Crear" class="btn btn-primary" name="createBtn"/>
        </form>
    </div>
</div>
<?php
    $sendData = false;
    $seriesCreated = false;

    if(isset($_POST['createBtn'])) {
        $sendData = true;
    }
    
    if($sendData) {
        if(isset($_POST['seriesTitulo']) && isset($_POST['plataformaId'])) {
            $seriesCreated = storeSeries($_POST['seriesTitulo'], $_POST['plataformaId'], $_POST['directorId'], $_POST['actores'], $_POST['idiomasAudio'], $_POST['idiomasSubtitulos']);
        }
    }

    if(!$sendData) {
?>
<?php
    } else {
        if ($seriesCreated) {
            ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Serie creada correctamente.<br><a href="index.php?controller=series&action=list">Volver al listado de series</a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    La serie no se ha creado correctamente.<br><a href="index.php?controller=series&action=create">Volver a intentarlo</a>
                </div>
            </div>
            <?php
        }
    }
?>