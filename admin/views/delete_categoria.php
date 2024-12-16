<?PHP
$id = $_GET['id'] ?? FALSE;
$categoria = Categoria::get_x_id($id);

?>

<div class="row">
    <div class="col">

        <h2 class="mt-3 mt-md-5 fs-3">Estás por borrar esta categoría </span>
        </h2>
        <div class="row mb-5 d-flex align-items-center mt-5">


            <div class="col-md-12 mb-3">
                <h3>Nombre</h3>
                <p> <?= $categoria->getNombre() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Descripción</h3>
                <p> <?= $categoria->getDescripcion() ?> </p>
            </div>

            <a href="actions/delete_categoria_acc.php?id=<?= $categoria->getId() ?>" role="button" class="row g-3 btn btn-primary btn-acento">Eliminar</a>


        </div>
    </div>
</div>