<div class="container">
    <?php
        $idSeries = $_GET['id'];
        $seriesObject = getSeriesData($idSeries);
    ?>
    <div class="row">
        <div class="col-12">
            <h1>Editar Serie</h1>
        </div>
        <div class="col-12">
            <form name="edit_series" action="" method="POST">
                <div class="mb-3">
                    <input type="hidden" name="seriesId" value="<?php echo $idSeries; ?>">
                    <label for="seriesTitulo" class="form-label">Título</label>
                    <input id="seriesTitulo" name="seriesTitulo" type="text" placeholder="Introduce el título de la serie" class="form-control" required value="<?php if(isset($seriesObject)) echo $seriesObject->getTitulo(); ?>">
                    <label for="plataformaId" class="form-label">Plataforma</label>
                    <select id="plataformaId" name="plataformaId" class="form-control">
                        <option value="">Selecciona una plataforma</option>
                        <?php
                            $platforms = listPlatforms(); 
                            foreach ($platforms as $platform): ?>
                            <option value="<?= $platform->getId() ?>" <?php if(isset($seriesObject) && $seriesObject->getPlataformaId() == $platform->getId()) echo "selected"; ?>><?= $platform->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="directorId" class="form-label">Director</label>
                    <select id="directorId" name="directorId" class="form-control">
                        <option value="">Selecciona un director</option>
                        <?php
                            $directors = listDirectors(); 
                            foreach ($directors as $director): ?>
                            <option value="<?= $director->getId() ?>" <?php if(isset($seriesObject) && $seriesObject->getDirectorId() == $director->getId()) echo "selected"; ?>><?= $director->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="actores" class="form-label">Actores</label>
                    <textarea id="actores" name="actores" placeholder="Introduce los actores de la serie" class="form-control"><?php if(isset($seriesObject)) echo $seriesObject->getActores(); ?></textarea>
                    <label for="idiomasAudio" class="form-label">Idiomas Audio</label>
                    <textarea id="idiomasAudio" name="idiomasAudio" placeholder="Introduce los idiomas de audio de la serie" class="form-control"><?php if(isset($seriesObject)) echo $seriesObject->getIdiomasAudio(); ?></textarea>
                    <label for="idiomasSubtitulos" class="form-label">Idiomas Subtítulos</label>
                    <textarea id="idiomasSubtitulos" name="idiomasSubtitulos" placeholder="Introduce los idiomas de subtítulos de la serie" class="form-control"><?php if(isset($seriesObject)) echo $seriesObject->getIdiomasSubtitulos(); ?></textarea>
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn"/>
            </form>
        </div>
    </div>
    <?php
        $sendData = false;
        $seriesEdited = false;

        if(isset($_POST['editBtn'])) {
            $sendData = true;
        }

        if($sendData) {
            if(isset($_POST['seriesTitulo'])) {
                $seriesEdited = updateSeries($_POST['seriesId'], $_POST['seriesTitulo'], $_POST['plataformaId'], $_POST['directorId'], $_POST['actores'], $_POST['idiomasAudio'], $_POST['idiomasSubtitulos']);
            }
        }
        
        if(!$sendData) {
            ?>
            <?php
        } else {
            if($seriesEdited) {
                ?>
                <div class="row">
                    <div class="alert alert-success" role="alert">
                        Serie editada correctamente.<br><a href="index.php?controller=series&action=list">Volver al listado de series</a>
                    </div>
                </div>
                <?php
            }
            else {
                ?>
                <div class="row">
                    <div class="alert alert-danger" role="alert">
                        La serie no se ha editado correctamente.<br><a href="index.php?controller=series&action=edit&id=<?php echo $idSeries; ?>">Volver a intentarlo</a>
                    </div>
                </div>
                <?php
            }
        }
    ?>
</div>