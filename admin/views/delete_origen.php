<?PHP
$id = $_GET['id'] ?? FALSE;
$origen = Origen::get_x_id($id);

?>

<div class="row">
    <div class="col">

        <h2 class="mt-3 mt-md-5 fs-3">Estás por borrar este lugar de origen
        </h2>
        <div class="row mb-5 d-flex align-items-center mt-5">


            <div class="col-md-12 mb-3">
                <h3>Nombre</h3>
                <p> <?= $origen->getNombre() ?> </p>
            </div>

            <div class="col-md-12 mb-3">
                <h3>Descripción</h3>
                <p> <?= $origen->getDescripcion() ?> </p>
            </div>

            <a href="actions/delete_origen_acc.php?id=<?= $origen->getId() ?>" role="button" class="row g-3 btn btn-primary btn-acento">Eliminar</a>


        </div>
    </div>
</div>