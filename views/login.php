<div class="p-5">
    <h2> Inicia sesión </h2>




    <div class="mt-5 containerForm">

        <div>

            <?= Alerta::get_alertas(); ?>

        </div>

        <div id="formulario">

            <form action="admin/actions/aut_login_acc.php" method="post">


                <p class="p-form">Ingresa tus datos</p>


                <div class="form-floating mb-3 m-auto">
                    <div class="form-floating mb-3 m-auto">
                        <input type="text" name="nombreusuario" class="form-control" id="nombreusuario" placeholder="Nombre de Usuario" required>
                        <label for="nombreusuario"> Nombre de Usuario </label>
                    </div>

                </div>

                <div class="form-floating">


                    <div class="form-floating mb-3 m-auto">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" required>
                        <label for="password"> Contraseña </label>
                    </div>
                </div>

                <button type="submit" class="mt-5 btn btn-acento">Iniciá sesión</button>
            </form>

        </div>
    </div>
</div>