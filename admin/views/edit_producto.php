<?PHP
$id = $_GET['id'] ?? FALSE;
$producto = Producto::productoId($id);
$m_selected = $producto->getMateriales();

$categoria = Categoria::lista_completa();
$material = Material::lista_completa();
$origen = Origen::lista_completa();

//echo "<pre>";
//print_r($m_selected[0]->getId());
//echo "</pre>";


?>

<div class="row">
    <div class="col">

        <h2 class="mt-3 mt-md-5 fs-3">Editar Producto
        </h2>

        <div class="row mb-5 d-flex align-items-center">

            <form class="row g-3" action="actions/edit_producto_acc.php?id=<?= $producto->getId() ?>" method="POST" enctype="multipart/form-data">

                <div class="col-md-6 mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select class="form-select" name="categoria_id" id="categoria_id" required>
                        <option value="" selected disabled>Elegí una opción</option>
                        <?PHP foreach ($categoria as $C) { ?>
                            <option value="<?= $C->getId() ?>" <?= $C->getId() == $producto->getCategoriaId() ? "selected" : "" ?>>
                                <?= $C->getNombre() ?>
                            </option>
                        <?PHP } ?>
                    </select>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-panel" id="nombre" name="nombre" value="<?= $producto->getNombre() ?>" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control form-control-panel" id="descripcion" name="descripcion">  <?= $producto->getDescripcion() ?> </textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" class="form-control form-control-panel" id="precio" name="precio" value="<?= $producto->getPrecio() ?>" required>
                    <div class="form-text">Ingresar el precio</div>
                </div>


                <div class="col-md-6 mb-3">
                    <label for="fecha_origen" class="form-label">Fecha de origen</label>
                    <input type="number" class="form-control form-control-panel" id="fecha_origen" name="fecha_origen" value="<?= $producto->getFecha_origen() ?>" required>
                    <div class="form-text">Ingresar el año de fabricación del producto</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="lugar_origen_id" class="form-label">Lugar de origen</label>
                    <select class="form-select" name="lugar_origen_id" id="lugar_origen_id" required>
                        <option value="" selected disabled>Elegí el nombre del país de origen</option>
                        <?PHP foreach ($origen as $O) { ?>
                            <option value="<?= $O->getId() ?>" <?= $O->getId() == $producto->getLugar_origenId() ? "selected" : "" ?>>
                                <?= $O->getNombre() ?>
                            </option>
                        <?PHP } ?>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control form-control-panel" id="stock" name="stock" value="<?= $producto->getStock() ?>" required>
                    <div class="form-text">Ingresar cantidad en stock</div>
                </div>


                <div class="col-md-2 mb-3">
                    <label for="img_og" class="form-label">Imagen Actual</label>
                    <img src="../imagenes/productos/<?= $producto->getImg() ?>" alt="<?= $producto->getAlt() ?>" class="img-fluid rounded shadow-sm d-block">
                    <input class="form-control" type="hidden" id="img_og" name="img_og" required value="<?= $producto->getImg() ?>">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="img" class="form-label">Reemplazar Imagen</label>
                    <input class="form-control" type="file" id="img" name="img">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="alt" class="form-label">Texto alternativo </label>
                    <input type="text" class="form-control form-control-panel" id="alt" name="alt" value="<?= $producto->getAlt() ?>" required>
                    <div class="form-text">Vuelve tus imágenes accesibles agregando una descripción</div>
                </div>


                <div class="col-md-12 mb-3">
                    <label class="form-label d-block">Materiales</label>
                    <?PHP foreach ($material as $M) { ?>
                        <div class="form-check form-check-inline">

                            <input class="form-check-input" type="checkbox" name="material[]" id="material_<?= $M->getId() ?>" value="<?= $M->getId() ?>" 
                            
                                <?PHP foreach($m_selected as $ms) {
                                    if($M->getId() == $ms->getId()) {
                                        echo "checked";
                                    } else {
                                        "";
                                    }
                                }?>
                            >
                            <label class="form-check-label mb-2" for="material_<?= $M->getId() ?>">
                                <?= $M->getNombre() ?>
                            </label>

                        </div>
                    <?PHP } ?>
                </div>

                <button type="submit" class="btn btn-primary btn-acento">Cargar</button>

            </form>
        </div>
    </div>
</div>