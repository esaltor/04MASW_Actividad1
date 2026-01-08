
<div class="col-12">
    <div style="margin-bottom: 12px;">
        <a class="btn btn-primary" href="index.php?controller=language&action=create">Crear Idioma</a>
    </div>
    <?php
        $languageList = listLanguages();

        if (count($languageList) > 0) {
    ?>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Nombre</th>
                <th>ISO</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php
        foreach ($languageList as $language) {
                ?>
                    <tr>
                        <td><?php
        echo $language->getId(); ?></td>
                        <td><?php
        echo $language->getNombre(); ?></td>
                        <td><?php
        echo $language->getIsoCode(); ?></td>
                        <td>
                            <div class="table-actions" role="group" aria-label="Acciones">
                                <a class="btn btn-success" href="index.php?controller=language&action=edit&id=<?php
        echo $language->getId(); ?>">Editar</a>

                                <form name="delete_language" action="index.php?controller=language&action=delete" method="POST" style="...">
                                    <input type="hidden" name="languageId" value="<?php
        echo $language->getId(); ?>" />
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
        Aún no existen Idiomas
    </div>
    <?php
        }
    ?>
</div>
