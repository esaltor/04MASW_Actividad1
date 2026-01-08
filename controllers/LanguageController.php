<?php
    require_once __DIR__ . '/../models/Language.php';

    function listLanguages() {
        $model = new Language();
        $languageList = $model->getAll();
        $languageObjectArray = [];

        foreach ($languageList as $languageItem) {
            
            $languageObject = new Language($languageItem->getId(), $languageItem->getNombre(), $languageItem->getIsoCode());
            array_push($languageObjectArray, $languageObject);
        }

        return $languageObjectArray; 
    }

    function storeLanguage($nombre, $isoCode) {
        $model = new Language();
        $model->setNombre($nombre);
        $model->setIsoCode($isoCode);
        return $model->store();
    }


     function updateLanguage ($languageId, $languageName, $isoCode) {
        $language = new Language($languageId, $languageName, $isoCode);

        $languageEdited = $language->update();

        return $languageEdited;
    }

    function getLanguageData($idLanguage) {
        echo $idLanguage;
        $language = new Language($idLanguage);
        $languageObject = $language->getItem();

        return $languageObject;
    }

    function deleteLanguage($languageId) {
        $language = new Language($languageId);
        $languageDeleted = $language->delete();

        return $languageDeleted;
    }

?>
