<?php


// Me traigo de la superglobal GET el tipo de filtro y el dato o categoría que se ha seleccionado y sino devuelve false
$tipoFiltro = isset($_GET['filtro']) ? $_GET['filtro'] : false;
$categoriaSeleccionada = isset($_GET['cat']) ? $_GET['cat'] : false;

// Si la categoría y el tipo de filtro es true, guardo en catalogo los productos de la categoría seleccionada

if ($tipoFiltro == "categoria" || $tipoFiltro == "lugar_origen" && $categoriaSeleccionada) {
  $catalogo = Producto::catalogoFiltradoAEleccion($tipoFiltro, $categoriaSeleccionada);
} else if ($tipoFiltro == "fecha_origen" && $categoriaSeleccionada) {
  $catalogo = Producto::filtroAntiguedad($categoriaSeleccionada);
} else if ($tipoFiltro == "precio" && $categoriaSeleccionada) {
  $catalogo = Producto::filtroPrecio($categoriaSeleccionada);
} else if ($tipoFiltro == "materiales" && $categoriaSeleccionada) {
  $catalogo = Producto::filtroMateriales($categoriaSeleccionada);
} else {
  $catalogo = Producto::catalogoCompleto();
  $titulo = "Shop Online";
}


Producto::catalogoCompleto();

//echo "<pre>";
//print_r($catalogo);
//echo "</pre>";

// Me traigo lista de categorías para que algunos filtros sean dinámicos
$listaCategorias = Categoria::listado_completo();
$listaOrigenes = Origen::listado_completo();
$listaMateriales = Material::listado_completo();



?>

<h2 class="mt-3 mt-md-5 fs-3"><?= $titulo ?> </h2>

<div class="btn-group mt-3 mt-md-5" role="group" aria-label="Basic outlined example">
  <a type="button" class="btn btn-outline-primary" href="index.php?sec=productoscatalogo">Ver menos filtros <img src="imagenes/iconos/filterOn.svg" alt="icono para desactivar filtros"></a>
</div>

<div class="row">

  <nav class="d-none d-lg-block col-lg-3 d-md-none d-sm-none navLateral mt-4">



    <h2 class="p-4">Filtrá tus preferencias</h2>

    <div class="mt-3">

      <p class="ulFiltros mx-4">Categoría</p>
      <ul>


        <li><a class="nav-item mt-2" href="index.php?sec=filtros">Todos</a></li>

        <?PHP foreach ($listaCategorias as $e) { ?>

          <li><a class="nav-item mt-2" href="index.php?sec=filtros&filtro=categoria&cat=<?= $e['id'] ?>"> <?= $e['nombre'] ?> </a></li>

        <?PHP } ?>

      </ul>

      <p class="ulFiltros mx-4 mt-4">Antigüedad</p>
      <ul>


        <li><a class="nav-item" href="index.php?sec=filtros&filtro=fecha_origen&cat=1950">50`s</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=fecha_origen&cat=1960">60`s</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=fecha_origen&cat=1970">70`s</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=fecha_origen&cat=1980">80`s</a></li>

      </ul>

      <p class="ulFiltros mx-4 mt-4">Precio</p>
      <ul>


        <li><a class="nav-item" href="index.php?sec=filtros&filtro=precio&cat=00">Hasta $50.000</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=precio&cat=50000">$50.000 a $100.000</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=precio&cat=100000">$100.000 a $150.000</a></li>
        <li><a class="nav-item" href="index.php?sec=filtros&filtro=precio&cat=150000">Más de $150.000</a></li>

      </ul>

      <p class="ulFiltros mx-4 mt-4"> Lugar origen</p>
      <ul>



        <?PHP foreach ($listaOrigenes as $e) { ?>

          <li><a class="nav-item" href="index.php?sec=filtros&filtro=lugar_origen&cat=<?= $e['id'] ?>"> <?= $e['nombre'] ?> </a></li>

        <?PHP } ?>


      </ul>

      <p class="ulFiltros mx-4 mt-4"> Materiales</p>
      <ul>



        <?PHP foreach ($listaMateriales as $e) { ?>

          <li><a class="nav-item" href="index.php?sec=filtros&filtro=materiales&cat=<?= $e['nombre'] ?>"> <?= $e['nombre'] ?> </a></li>

        <?PHP } ?>


      </ul>


    </div>

  </nav>




  <div class="col-sm-12 col-md-12 col-lg-9">
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
  </div>
</div>