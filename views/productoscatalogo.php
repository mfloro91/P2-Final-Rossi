<?php

// Me traigo de la superglobal GET la categoría que se ha seleccionado y sino devuelve false
$categoriaSeleccionada = isset($_GET['cat']) ? $_GET['cat'] : false;

// Si la categoría es true, guardo en catalogo los productos de la categoría seleccionada

if ($categoriaSeleccionada) {
  $catalogo = Producto::catalogoFiltrado($categoriaSeleccionada);
} else {
  $catalogo = Producto::catalogoCompleto();
}

Producto::catalogoCompleto();

// Me traigo lista de categorías para que filtros sean dinámicos
$listaCategorias = Categoria::listado_completo();

?>

<h2 class="mt-3 mt-md-5 fs-3"><?= $titulo ?> </h2>

<div class="btn-group mt-3 mt-md-5" role="group" aria-label="Basic outlined example">
  <a type="button" class="btn btn-outline-primary" href="index.php?sec=productoscatalogo">Todos</a>

  <?PHP foreach ($listaCategorias as $cat) { ?>

    <a type="button" class="btn btn-outline-primary" href="index.php?sec=productoscatalogo&cat=<?= $cat['id'] ?>"> <?= $cat['nombre'] ?> </a>

  <?PHP } ?>

  <a type="button" class="btn btn-outline-primary d-sm-none d-lg-block" href="index.php?sec=filtros">Ver más filtros <img src="imagenes/iconos/filterOff.svg" alt="icono para activar filtros"></a>

</div>



<div class="row mt-3 g-2">

  <?php

  if (!empty($catalogo)) {
    foreach ($catalogo as $producto) { ?>



      <div class="col-12 col-md-6 col-lg-3 p-1">
        <div class="cardProductos">
          <img src="imagenes/productos/<?= $producto->getImg() ?>" class="card-img-top rounded img-card" alt="<?= $producto->getAlt() ?>">
          <div class="card-body">
            <h3 class="card-title"><?= $producto->getNombre() ?></h3>
            <p class="card-text"><?= $producto->getDescripcion() ?></p>
            <p class="card-text fw-bolder fs-5"> $<?= number_format($producto->getPrecio(), 0, ",", ".") ?> </p>
          </div>
          <div class="buttonCard">
            <a href="index.php?sec=detalleproducto&id=<?= $producto->getId() ?>" class="btn btn-primary btn-acento">Ver más</a>
          </div>

        </div>
      </div>


    <?php
    }
  } else { ?>

    <div class="col">
      <h3 class="m-5 text-left">Aún no tenemos productos en esta categoría.</h3>
    </div>

  <?PHP } ?>

</div>