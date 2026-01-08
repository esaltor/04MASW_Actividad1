<div class="col-12">
    <div style="margin-bottom: 12px;">
        <a class="btn btn-primary" href="index.php?controller=director&action=create">Crear director</a>
    </div>
    <?php
        $directorList = listDirectors();

        if (count($directorList) > 0) {
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
        foreach ($directorList as $director) {
                ?>
                    <tr>
                        <td><?php
        echo $director->getId(); ?></td>
                        <td><?php
        echo $director->getName(); ?></td>
                        <td><?php
        echo $director->getSurnames(); ?></td>
                        <td><?php
        echo date("d/m/Y", strtotime($director->getBirthdate())); ?></td>
                        <td><?php
        echo $director->getNationality(); ?></td>
                        <td>
                            <div class="table-actions" role="group" aria-label="Acciones">
                                <a class="btn btn-success" href="index.php?controller=director&action=edit&id=<?php
        echo $director->getId(); ?>">Editar</a>

                                <form name="delete_director" action="index.php?controller=director&action=delete" method="POST">
                                    <input type="hidden" name="directorId" value="<?php
        echo $director->getId(); ?>" />
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
        Aún no existen directores
    </div>
    <?php
        }
    ?>
</div>
