<div class="row">

    <h2 class="mt-3 mt-md-5 fs-3">Agregar una nueva categoría de productos</h2>

        <div class="row mb-5 d-flex align-items-center">

            <form class="row g-3" action="actions/add_categoria_acc.php" method="POST" enctype="multipart/form-data">

                <div class="col-md-12 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control form-control-panel" id="nombre" name="nombre" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea class="form-control form-control-panel" id="descripcion" name="descripcion"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-acento">Cargar</button>

            </form>

        </div>

</div>