<?php
$compras = Compra::listadoCompras();

?>

<h2 class="mt-3 mt-md-5 fs-3">Visualiza las ventas de Vecchio</h2>

<div>

    <?= Alerta::get_alertas(); ?>

</div>

<div class="row mb-5 d-flex align-items-center">

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col" width="15%">Nº compra</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Mail usuario</th>
                <th scope="col">Fecha compra</th>
                <th scope="col">Importe</th>
                <th scope="col">Detalle</th>
            </tr>
        </thead>
        <tbody>

            <?PHP foreach ($compras as $compra) { ?>
                <tr>
                    <td> <?= $compra['id'] ?></td>
                    <td><?= $compra['nombre_completo'] ?></td>
                    <td><?= $compra['email'] ?></td>
                    <td><?= $compra['fecha'] ?></td>
                    <td><?= $compra['importe'] ?> </td>
                    <td><?= $compra['detalle'] ?> </td>
                </tr>
            <?PHP } ?>

        </tbody>
    </table>

</div>