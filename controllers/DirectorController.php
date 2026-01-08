<?php
    require_once __DIR__ . '/../models/Director.php';

    function listDirectors()
    {
        $model = new Director();
        $directorList = $model->getAll();
        $directorObjectArray = [];

        foreach ($directorList as $directorItem) {
            $directorObject = new Director(
                $directorItem->getId(),
                $directorItem->getName(),
                $directorItem->getSurnames(),
                $directorItem->getBirthdate(),
                $directorItem->getNationality()
            );
            array_push($directorObjectArray, $directorObject);
        }

        return $directorObjectArray;
    }

    function storeDirector(
        $directorName,
        $directorSurnames,
        $directorBirthdate,
        $directorNationality
    ) {
        // Validaciones generales
        if (
            empty($directorName) ||
            empty($directorSurnames) ||
            empty($directorBirthdate) ||
            empty($directorNationality)
        ) {
            return false;
        }

        // Validar fecha
        $date = DateTime::createFromFormat('Y-m-d', $directorBirthdate);
        if (!$date) {
            return false;
        }

        // Llamar al modelo
        $newDirector = new Director(
            null,
            $directorName,
            $directorSurnames,
            $directorBirthdate,
            $directorNationality
        );

        return $newDirector->store();
    }

    function updateDirector(
        $directorId,
        $directorName,
        $directorSurnames,
        $directorBirthdate,
        $directorNationality
    ) {

        // Validaciones generales
        if (
            empty($directorId) ||
            empty($directorName) ||
            empty($directorSurnames) ||
            empty($directorBirthdate) ||
            empty($directorNationality)
        ) {
            return false;
        }

        // Validacion fecha
        $date = DateTime::createFromFormat('Y-m-d', $directorBirthdate);
        if (!$date) {
            return false;
        }

        // Llamar al modelo
        $director = new Director(
            $directorId,
            $directorName,
            $directorSurnames,
            $directorBirthdate,
            $directorNationality
        );

        return $director->update();
    }

    function getDirectorData($idDirector) {
        $director = new Director($idDirector);
        $directorObject = $director->getItem();

        return $directorObject;
    }

    function deleteDirector($directorId) {
        $director = new Director($directorId);
        $directorDeleted = $director->delete();

        return $directorDeleted;
    }
?>
