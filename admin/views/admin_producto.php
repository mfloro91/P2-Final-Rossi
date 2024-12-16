<?PHP
$productos = Producto::catalogoCompleto();
?>


<h2 class="mt-3 mt-md-5 fs-3">Administra Productos</h2>


<div>

    <?= Alerta::get_alertas(); ?>

</div>

<div class="row mb-5 d-flex align-items-center">

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col" width="15%">Imagen</th>
                <th scope="col" width="15%">Alt</th>
                <th scope="col" width="15%">Categoría</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Lugar de Origen</th>
                <th scope="col">Fecha de Origen</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>

            <?PHP foreach ($productos as $producto) { ?>
                <tr>
                    <td><img src="../imagenes/productos/<?= $producto->getImg() ?>" alt="<?= $producto->getAlt() ?>" class="card-img-top rounded"> </td>
                    <td><?= $producto->getAlt() ?></td>
                    <td><?= $producto->getCategoria() ?></td>
                    <td><?= $producto->getNombre() ?></td>
                    <td><?= $producto->getDescripcion() ?></td>
                    <td><?= $producto->getLugar_origen() ?></td>
                    <td><?= $producto->getFecha_origen() ?></td>
                    <td><?= $producto->getStock() ?></td>
                    <td><?= $producto->getPrecio() ?></td>
                    <td>
                        <a href="index.php?sec=edit_producto&id=<?= $producto->getId() ?>" role="button" class="d-block btn btn-sm btn-primary btn-acento mb-1">Editar</a>
                        <a href="index.php?sec=delete_producto&id=<?= $producto->getId() ?>" role="button" class="d-block btn btn-sm btn-outline-primary">Eliminar</a>
                    </td>
                </tr>
            <?PHP } ?>

        </tbody>
    </table>

    <a href="index.php?sec=add_producto" class="btn btn-primary btn-acento mt-5"> Cargar nuevo producto</a>
</div>