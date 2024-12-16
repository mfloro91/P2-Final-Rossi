<?php
$carrito = Carrito::get_carrito();


?>

<div class="p-5">
    <h2 class="mt-3 mt-md-5 fs-3"><?= $titulo ?> </h2>
    <p class="mt-3"> ¡Hola <strong> <?= $_SESSION['usuarioLogueado']['nombre_completo'] ?></strong>! Este es el detalle de tu compra: </p>
</div>

<?php

if (count($carrito)) { ?>


    <?php

    foreach ($carrito as $productoID => $productoCarrito) { ?>

        <div class="col-12">
            <div class="cardProductos h-50">
                <div class="row">
                    <div class="col-3">
                        <img src="imagenes/productos/<?= $productoCarrito['img'] ?>" class="card-img-top rounded img-card" alt="<?= $productoCarrito['alt'] ?>">
                    </div>
                    <div class="card-body col-6">
                        <h3 class="card-title"><?= $productoCarrito['nombre'] ?></h3>
                        <p class="card-text mt-3">Categoría: <?= $productoCarrito['categoria'] ?></p>
                        <p class="card-text"> Origen: <?= $productoCarrito['lugar_origen'] ?></p>
                        <p class="card-text">Cantidad: <?= $productoCarrito['cantidad'] ?></p>
                    </div>
                </div>
            </div>
        </div>


    <?php } ?>

    <div class="d-flex totalCarrito">

        <h3 class="h5 m-5">Total:</h2>
            <p class="h5 m-5">$<?= number_format(Carrito::precio_total(), 2, ",", ".") ?></p>
    </div>
    <a href="admin/actions/checkout_acc.php" class="btn btn-primary btn-acento"> Pagar </a>


<?php } ?>