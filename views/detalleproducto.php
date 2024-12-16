<?php

$id = $_GET["id"] ?? false;

$productoSeleccionado = Producto::productoId($id);

$material = Material::lista_completa();
$m_selected = $productoSeleccionado->getMateriales();


?>

<div class="row mt-5">

    <?PHP if (!empty($productoSeleccionado)) { ?>

        <div class="col-12 col-lg-6 px-1  d-flex flex-direction-row justify-content-center align-items-center">
            <div class="flex-direction-column">
                <img src="imagenes/productos/<?= $productoSeleccionado->getImg() ?>" alt="<?= $productoSeleccionado->getAlt() ?>" class="img-fluid">
            </div>
        </div>

        <div class="col-12 col-lg-6  mt-5 text-lg-start ps-md-5">
            <h2 class="h3 fw-bolder"> <?= $productoSeleccionado->getNombre() ?> </h2>
            <p class="w-75 m-auto m-lg-0"> <?= $productoSeleccionado->getDescripcion() ?> </p>


            <div class="detalleProducto">
                <h3>Materiales</h3>
                <ul>
                    <?PHP foreach ($m_selected as $M) { ?>
                        <li class="listaMateriales"> <?= $M->getNombre() ?> </li>
                    <?PHP } ?>
                </ul>
            </div>



            <div class="detalleProducto">
                <p class="w-75 m-auto m-lg-0"> Lugar de origen: <?= $productoSeleccionado->getLugar_origen() ?> </p>
                <p class="w-75 m-auto m-lg-0"> Fecha fabricación: <?= $productoSeleccionado->getFecha_origen() ?> </p>
                <p class="w-75 m-auto m-lg-0"> Stock: <?= $productoSeleccionado->getStock() ?> </p>

            </div>

            <p class="h4 mt-4">$<?= number_format($productoSeleccionado->getPrecio(), 0, ",", ".") ?></p>
            <div class="mt-3">
                <img src="imagenes/iconos/payment.svg" alt="Icono tarjeta de credito">
                <p class="d-inline">Paga con tarjeta de crédito</p>
            </div>
            <div class="mt-3">
                <img src="imagenes/iconos/shipping.svg" alt="imagen camión envíos">
                <p class="d-inline">Envíos gratis a CABA</p>
            </div>

            <form action="admin/actions/add_productoCarrito_acc.php" method="GET" class="row">
                <div class="col-6 d-flex align-items-center">
                    <label for="cantidad" class="fw-bold me-2">Cantidad: </label>
                    <input type="number" class="form-control" value="1" name="cantidad" id="cantidad">
                </div>
                <div class="col-6">
                    <input type="submit" value="Agregar al carrito" class="btn btn-primary btn-acento mt-5 mb-5">
                    <input type="hidden" value="<?= $id ?>" name="id" id="id">
                </div>
            </form>

        </div>

    <?PHP } else { ?>

        <div class="col">
            <h2 class="text-center m-5">No se encontró el producto deseado.</h2>
        </div>

    <?PHP } ?>


</div>