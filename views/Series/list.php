<div class="col-12">
    <div style="margin-bottom: 12px;">
        <a class="btn btn-primary" href="index.php?controller=series&action=create">Crear Serie</a>
    </div>
    <?php
        $seriesList = listSeries();

        if (count($seriesList) > 0) {
    ?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Titulo</th>
                <th>Plataforma</th>
                <th>Director</th>
                <th>Actores</th>
                <th>Idiomas Audio</th>
                <th>Idiomas Subtítulos</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
        foreach ($seriesList as $series) {
                ?>
                    <tr>
                        <td><?php
        echo $series->getId(); ?></td>
                        <td><?php
        echo $series->getTitulo(); ?></td>
                        <td><?php
        echo $series->getPlataformaNombre(); ?></td>
                        <td><?php
        echo $series->getDirectorNombre(); ?></td>
                        <td><?php
        echo $series->getActores(); ?></td>
                        <td><?php
        echo $series->getIdiomasAudio(); ?></td>
                        <td><?php
        echo $series->getIdiomasSubtitulos(); ?></td>
                        <td>
                            <div class="table-actions" role="group" aria-label="Acciones">
                                <a class="btn btn-success" href="index.php?controller=series&action=edit&id=<?php
        echo $series->getId(); ?>">Editar</a>

                                <form name="delete_series" action="index.php?controller=series&action=delete" method="POST" style="...">
                                    <input type="hidden" name="seriesId" value="<?php
        echo $series->getId(); ?>" />
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
        Aún no existen Series
    </div>
    <?php
        }
    ?>
</div>