<?PHP
$categorias = Categoria::lista_completa();
?>


<h2 class="mt-3 mt-md-5 fs-3">Administra Categorías</h2>

<div>

    <?= Alerta::get_alertas(); ?>

</div>


<div class="row mb-5 d-flex align-items-center">

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
            </tr>
        </thead>
        <tbody>

            <?PHP foreach ($categorias as $categoria) { ?>
                <tr>

                    <td><?= $categoria->getNombre() ?></td>
                    <td><?= $categoria->getDescripcion() ?></td>

                    <td>
                        <a href="index.php?sec=edit_categoria&id=<?= $categoria->getId() ?>" role="button" class="d-block btn btn-sm btn-primary btn-acento mb-1">Editar</a>
                        <a href="index.php?sec=delete_categoria&id=<?= $categoria->getId() ?>" role="button" class="d-block btn btn-sm btn-outline-primary">Eliminar</a>
                    </td>
                </tr>
            <?PHP } ?>

        </tbody>
    </table>

    <a href="index.php?sec=add_categoria" class="btn btn-primary btn-acento mt-5"> Cargar nueva categoría </a>
</div>