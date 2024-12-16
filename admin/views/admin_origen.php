<?PHP
$origenes = Origen::lista_completa();
?>


<h2 class="mt-3 mt-md-5 fs-3">Administra Lugares de Origen</h2>


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

            <?PHP foreach ($origenes as $origen) { ?>
                <tr>

                    <td><?= $origen->getNombre() ?></td>
                    <td><?= $origen->getDescripcion() ?></td>

                    <td>
                        <a href="index.php?sec=edit_origen&id=<?= $origen->getId() ?>" role="button" class="d-block btn btn-sm btn-primary btn-acento mb-1">Editar</a>
                        <a href="index.php?sec=delete_origen&id=<?= $origen->getId() ?>" role="button" class="d-block btn btn-sm btn-outline-primary">Eliminar</a>
                    </td>
                </tr>
            <?PHP } ?>

        </tbody>
    </table>

    <a href="index.php?sec=add_origen" class="btn btn-primary btn-acento mt-5"> Cargar nuevo origen</a>
</div>