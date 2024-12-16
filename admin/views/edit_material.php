<?PHP
$id = $_GET['id'] ?? FALSE;
$material = Material::get_x_id($id);

?>

<div class="row">
    <div class="col">

    <h2 class="mt-3 mt-md-5 fs-3">Editar Material
    </h2>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_material_acc.php?id=<?= $material->getId()?>" method="POST" enctype="multipart/form-data">


                <div class="col-md-12 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-panel" id="nombre" name="nombre" value="<?= $material->getNombre() ?>" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control form-control-panel" id="descripcion" name="descripcion"> <?= $material->getDescripcion()?> </textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-acento">Editar</button>

            </form>
        </div>
    </div>
</div>