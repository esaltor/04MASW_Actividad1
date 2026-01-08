<?php
    require_once __DIR__ . '/../models/Platform.php';

    function listPlatforms() {
        $model = new Platform();
        $platformList = $model->getAll();
        $platformObjectArray = [];

        foreach ($platformList as $platformItem) {
            $platformObject = new Platform($platformItem->getId(), $platformItem->getName());
            array_push($platformObjectArray, $platformObject);
        }

        return $platformObjectArray;
    }

    function storePlatform($platformName) {
        $newPlatform = new Platform(null, $platformName);
        $platformCreated = $newPlatform->store();

        return $platformCreated;
    }

    function updatePlatform($platformId, $platformName) {
        $platform = new Platform($platformId, $platformName);

        $platformEdited = $platform->update();

        return $platformEdited;
    }

    function getPlatformData($idPlatform) {
        $platform = new Platform($idPlatform);
        $platformObject = $platform->getItem();

        return $platformObject;
    }

    function deletePlatform($platformId) {
        $platform = new Platform($platformId);
        $platformDeleted = $platform->delete();

        return $platformDeleted;
    }
?>
