<?php
    require_once __DIR__ . '/../models/Actor.php';

    function listActors() {
        $model = new Actor();
        $actorList = $model->getAll();
        $actorObjectArray = [];

        foreach ($actorList as $actorItem) {
            $actorObject = new Actor($actorItem->getId(), $actorItem->getName(), $actorItem->getSurnames(), $actorItem->getBirthDate(), $actorItem->getNationality());
            array_push($actorObjectArray, $actorObject);
        }

        return $actorObjectArray;
    }

    function storeActor($actorName, $actorLastName, $actorBirthDate, $actorNationality) {
        $newActor = new Actor(null, $actorName, $actorLastName, $actorBirthDate, $actorNationality);
        $actorCreated = $newActor->store();

        return $actorCreated;
    }

    function updateActor($actorId, $actorName, $actorLastName, $actorBirthDate, $actorNationality) {
        $actor = new Actor($actorId, $actorName, $actorLastName, $actorBirthDate, $actorNationality);
        $actorEdited = $actor->update();

        return $actorEdited;
    }

    function getActorData($actorId) {
        $actor = new Actor($actorId);
        $actorObject = $actor->getItem();

        return $actorObject;
    }

    function deleteActor($actorId) {
        $actor = new Actor($actorId);
        $actorDeleted = $actor->delete();

        return $actorDeleted;
    }
?>