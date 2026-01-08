<div class="col-12">
    <div style="margin-bottom: 12px;">
        <a class="btn btn-primary" href="index.php?controller=actor&action=create">Crear actor</a>
    </div>
    <?php
        $actorList = listActors();

        if (count($actorList) > 0) {
    ?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Fecha de nacimiento</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
        foreach ($actorList as $actor) {
                ?>
                    <tr>
                        <td><?php
        echo $actor->getId(); ?></td>
                        <td><?php
        echo $actor->getName(); ?></td>
                        <td><?php
        echo $actor->getSurnames(); ?></td>
                        <td><?php
        echo date("d/m/Y", strtotime($actor->getBirthDate())); ?></td>
                        <td><?php
        echo $actor->getNationality(); ?></td>
                        <td>
                            <div class="table-actions" role="group" aria-label="Acciones">
                                <a class="btn btn-success" href="index.php?controller=actor&action=edit&id=<?php
        echo $actor->getId(); ?>">Editar</a>

                                <form name="delete_actor" action="index.php?controller=actor&action=delete" method="POST">
                                    <input type="hidden" name="actorId" value="<?php
        echo $actor->getId(); ?>" />
                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php
        }
                ?>
            </tbody>
        </table>
    <?php
        } else {
    ?>
    <div class="alert alert-warning" role="alert">
        No existen actores
    </div>
    <?php
        }
    ?>
</div>