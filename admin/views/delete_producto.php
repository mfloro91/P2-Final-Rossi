<?PHP
$id = $_GET['id'] ?? FALSE;
$producto = Producto::productoId($id);
$material = Material::lista_completa();
$m_selected = $producto->getMateriales();

?>

<div class="row">
    <div class="col">

        <h2 class="mt-3 mt-md-5 fs-3">Estás por borrar este producto
        </h2>
        
        <div class="row mb-5 d-flex align-items-center mt-5">


            <div class="col-md-12 mb-3">
                <h3>Categoría</h3>
                <p> <?= $producto->getCategoria() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Nombre</h3>
                <p> <?= $producto->getNombre() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Descripcion</h3>
                <p> <?= $producto->getDescripcion() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Precio</h3>
                <p> <?= $producto->getPrecio() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Fecha de origen</h3>
                <p> <?= $producto->getFecha_origen() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Lugar de origen</h3>
                <p> <?= $producto->getLugar_origen() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Get Stock</h3>
                <p> <?= $producto->getStock() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Imagen</h3>
                <p> <?= $producto->getImg() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Texto Alternativo</h3>
                <p> <?= $producto->getAlt() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Materiales</h3>
                <ul>
                    <?PHP foreach ($m_selected as $M) { ?>
                        <li> <?= $M->getNombre() ?> </li>
                    <?PHP } ?>
                </ul>
            </div>

            <a href="actions/delete_producto_acc.php?id=<?= $producto->getId() ?>" role="button" class="row g-3 btn btn-primary btn-acento">Eliminar</a>


        </div>
    </div>
</div>