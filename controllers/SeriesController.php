<?php
    require_once __DIR__ . '/../models/Series.php';

    function listSeries() {
        $model = new Series();
        $seriesList = $model->getAllDirectorPlatform();
        #$seriesObjectArray = [];

        #foreach ($seriesList as $seriesItem) {
            
        #    $seriesObject = new Series($seriesItem->getId(), $seriesItem->getTitulo(), $seriesItem->getPlataformaId(), $seriesItem->getDirectorId(), $seriesItem->getActores(), $seriesItem->getIdiomasAudio(), $seriesItem->getIdiomasSubtitulos());
        #    array_push($seriesObjectArray, $seriesObject);
        #}

        #return $seriesObjectArray; 
        return $seriesList;

    }

    function storeSeries($titulo, $plataformaId, $directorId, $actores, $idiomasAudio, $idiomasSubtitulos) {
        $model = new Series();
        $model->setTitulo($titulo);
        $model->setPlataformaId($plataformaId);
        $model->setDirectorId($directorId);
        $model->setActores($actores);
        $model->setIdiomasAudio($idiomasAudio);
        $model->setIdiomasSubtitulos($idiomasSubtitulos);
        return $model->store();
    }


     function updateSeries ($seriesId, $seriesName, $plataformaId, $directorId, $actores, $idiomasAudio, $idiomasSubtitulos) {
        $series = new Series($seriesId, $seriesName, $plataformaId, $directorId, $actores, $idiomasAudio, $idiomasSubtitulos);
        echo "antes de update";
        $seriesEdited = $series->update();
        echo "después de update";
        return $seriesEdited;
    }

    function getSeriesData($idSeries) {

        $series = new Series($idSeries);
        $seriesObject = $series->getItem();

        return $seriesObject;
    }

    function deleteSeries($seriesId) {
        $series = new Series($seriesId);
        $seriesDeleted = $series->delete();

        return $seriesDeleted;
    }

?>
