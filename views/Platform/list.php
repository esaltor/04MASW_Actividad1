<div class="col-12">
    <div style="margin-bottom: 12px;">
        <a class="btn btn-primary" href="index.php?controller=platform&action=create">Crear plataforma</a>
    </div>
    <?php
        $platformList = listPlatforms();

        if (count($platformList) > 0) {
    ?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
        foreach ($platformList as $platform) {
                ?>
                    <tr>
                        <td><?php
        echo $platform->getId(); ?></td>
                        <td><?php
        echo $platform->getName(); ?></td>
                        <td>
                            <div class="table-actions" role="group" aria-label="Acciones">
                                <a class="btn btn-success" href="index.php?controller=platform&action=edit&id=<?php
        echo $platform->getId(); ?>">Editar</a>

                                <form name="delete_platform" action="index.php?controller=platform&action=delete" method="POST" style="...">
                                    <input type="hidden" name="platformId" value="<?php
        echo $platform->getId(); ?>" />
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
        No existen plataformas
    </div>
    <?php
        }
    ?>
</div>


