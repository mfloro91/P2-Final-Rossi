<?php
$carrito = Carrito::get_carrito();


?>

<div class="p-5">
    <h2 class="mt-3 mt-md-5 fs-3"><?= $titulo ?> </h2>
    <p class="mt-3"> A continuación podrás ver tus productos seleccionados </p>
</div>

<?php

if (count($carrito)) { ?>

    <form action="admin/actions/update_productoCarrito_acc.php" method="POST">

        <?php



        foreach ($carrito as $productoID => $productoCarrito) { ?>

            <div class="col-12">
                <div class="cardProductos carrito h-50">
                    <div class="row">
                        <div class="col-3">
                            <img src="imagenes/productos/<?= $productoCarrito['img'] ?>" class="card-img-top rounded img-card" alt="<?= $productoCarrito['alt'] ?>">
                        </div>
                        <div class="card-body col-6">
                            <h3 class="card-title"><?= $productoCarrito['nombre'] ?></h3>
                            <p class="card-text"><?= $productoCarrito['categoria'] ?></p>
                            <p class="card-text"><?= $productoCarrito['lugar_origen'] ?></p>
                            <p class="card-text fw-bolder fs-5"> $<?= number_format($productoCarrito['precio'], 0, ",", ".") ?> </p>

                            <label for="cantidad_<?= $productoID ?>" class="visually-hidden">Cantidad</label>
                            <p>Elige la cantidad:</p>
                            <input
                                type="number"
                                class="form-control"
                                value="<?= $productoCarrito['cantidad'] ?>"
                                id="cantidad_<?= $productoID ?>"
                                name="cantidad[<?= $productoID ?>]">

                            <p class="card-text mt-3 fw-bold">Subtotal: $<?= number_format($productoCarrito['cantidad'] * $productoCarrito['precio'], 2, ",", ".") ?> </p>
                            <a href="admin/actions/remove_productoCarrito_acc.php?id=<?= $productoID ?>" class="btn btn-sm btn-danger">Eliminar</a>

                        </div>
                    </div>
                </div>
            </div>


        <?php } ?>

        <div class="totalCarrito d-flex">

            <h3 class="h5 m-5">Total:</h2>
                <p class="h5 m-5">$<?= number_format(Carrito::precio_total(), 2, ",", ".") ?></p>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="index.php?sec=productoscatalogo" role="button" class="btn btn-outline-primary">Seguir comprando</a>
            <input type="submit" value="Actualizar cantidades" class="btn btn-outline-primary">
            <a href="admin/actions/clear_productoCarrito_acc.php" role="button" class="btn btn-outline-primary">Vaciar carrito</a>
            <a href="index.php?sec=pago" role="button" class="btn btn-primary btn-acento">Finalizar compra</a>
        </div>

    </form>

<?php } else { ?>

    <h2 class="text-center mb-5">Su carrito esta vacio</h2>

<?php } ?>