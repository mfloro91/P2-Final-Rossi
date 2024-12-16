<div class="p-5">
    <h2> Contacto </h2>


    <div class="mt-5 containerForm row">


        <div class="col-lg-6 d-none d-lg-block">
            <img src="imagenes/marca/form.png" alt="Persona escribe en máquina de escribir antigüa">
        </div>


        <div id="formulario" class="col-lg-6 col-md-12">
            <h3 class="h4"> <strong> Comunicate con nosotros </strong> </h3>
            <p class="mt-3">
                ¿Tenés muebles para vender?
            </p>
            <p>
                Llená el formulario y nos contactaremos con vos.
            </p>


            <form action="index.php?sec=gracias" method="post">


                <p class="p-form">Tus datos</p>


                <div class="form-floating mb-3 m-auto">
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                    <label for="nombre"> Nombre </label>
                </div>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="mfloro.91@gmail.com">
                    <label for="email">Email</label>
                </div>

                <p class="p-form mt-3"> Selecciona la categoría de los productos a vender </p>


                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="Muebles" name="categoriaMuebles" id="checkMuebles">
                    <label class="form-check-label" for="checkMuebles">
                        Muebles
                    </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="Electricos" name="categoriaElectricos" id="checkElectricos">
                    <label class="form-check-label" for="checkElectricos">
                        Eléctricos
                    </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="Musicales" name="categoriaMusicales" id="checkMusicales">
                    <label class="form-check-label" for="checkMusicales">
                        Musicales
                    </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="checkbox" value="Rodados" name="categoriaRodados" id="checkRodados">
                    <label class="form-check-label" for="checkRodados">
                        Rodados
                    </label>
                </div>


                <input type="submit" class="mt-5 btn btn-acento">
            </form>

        </div>
    </div>
</div>