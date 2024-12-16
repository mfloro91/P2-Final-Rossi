<?php
$userID = $_SESSION['usuarioLogueado']['id'] ?? FALSE;


?>

<div class="p-5">
    <h2 class="mt-3 mt-md-5"><?= $titulo ?> </h2>
    <p class="mt-3"> ¡Hola <strong> <?= $_SESSION['usuarioLogueado']['nombre_completo'] ?></strong>!</p>

    <div>

        <?= Alerta::get_alertas(); ?>

    </div>


</div>

<?PHP

$compras = Compra::compras_x_id_usuario($userID);

?>

<h3> Tu historial de compras </h3>

<div class="col-12">

    <?PHP foreach ($compras as  $C) { ?>

        <div class="cardProductos h-50">
            <div class="row">
                <div class="col-3">
                    <img src="imagenes/productos/<?= $C['img'] ?>" class="card-img-top rounded img-card" alt="<?= $C['alt'] ?>">
                </div>
                <div class="card-body col-6">
                    <p>Compra Nº: <?= $C['id'] ?></p>
                    <p> Fecha: <?= $C['fecha'] ?></p>
                    <p> Detalle: <?= $C['detalle'] ?></p>
                    <p> Importe: $<?= number_format($C['importe'], 0, ",", ".") ?></p>
                </div>
            </div>
        </div>

    <?PHP } ?>

</div>