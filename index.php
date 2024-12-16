<?php

require_once 'functions/autoload.php';

// Hago lista de secciones habilitadas para ingresar por url 

$seccionesHabilitadas = [
  "inicio" => [
    "titulo" => "Antigüedades",
    "restringido" => FALSE
  ],
  "productoscatalogo" => [
    "titulo" => "Shop Online",
    "restringido" => FALSE
  ],
  "filtros" => [
    "titulo" => "Shop Online",
    "restringido" => FALSE
  ],
  "detalleproducto" => [
    "titulo" => "Detalles Producto",
    "restringido" => FALSE
  ],
  "contacto" => [
    "titulo" => "Contacto",
    "restringido" => FALSE
  ],
  "gracias" => [
    "titulo" => "Formulario Enviado",
    "restringido" => FALSE
  ],
  "login" => [
    "titulo" => "Inicia sesión",
    "restringido" => FALSE
  ],
  "buscador" => [
    "titulo" => "Resultado de tu búsqueda",
    "restringido" => FALSE
  ],
  "carrito" => [
    "titulo" => "Tu carrito",
    "restringido" => FALSE
  ],
  "pago" => [
    "titulo" => "Paga tu compra",
    "restringido" => TRUE
  ],
  "panelusuario" => [
    "titulo" => "Tu perfil en Veccio",
    "restringido" => TRUE
  ],
];

// Traigo la superglobal GET con la url, decido que view mostrar

//$valoresGET = $_GET;
$seccion = isset($_GET["sec"]) ? $_GET["sec"] : "inicio";

if (array_key_exists($seccion, $seccionesHabilitadas)) {
  $vista = $seccion;
  $titulo = $seccionesHabilitadas[$seccion]["titulo"];

  if ($seccionesHabilitadas[$seccion]['restringido']) {
    Autenticacion::verify(FALSE);
  }
} else {
  $vista = "404";
  $titulo = "Error 404";
}

$userData = $_SESSION['usuarioLogueado'] ?? FALSE;



?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vecchio <?= $titulo ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="icon" type="imagenes/svg" href="imagenes/marca/logo.svg">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
</head>

<body>

  <header class="container-fluid text-center mt-4">

    <nav class="container-fluid navbar navbar-expand-lg sticky-top mb-3">

      <div class="container m-auto">

        <a class="navbar-brand marca fw-bolder fs-2" href="index.php?sec=inicio">
          <img src="./imagenes/marca/logolargo.svg" alt="Logo" class="d-inline-block align-text-middle ">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" data-bs-theme="dark" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarText">
          <div class="navbar-nav me-auto mb-2 mb-lg-0">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php?sec=inicio">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?sec=productoscatalogo">Shop Online</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?sec=contacto">Contacto</a>
              </li>

              <?PHP if ($userData) { ?>
              <?php if ($userData['rol'] == 'superadmin' || $userData['rol'] == 'admin' ) { ?>
              <li class="nav-item">
                <a class="nav-link" href='admin/index.php?sec=dashboard'>Panel Admin</a>
              </li>
              <?php }} ?>

              <li class="mx-5">
                <?php if ($seccion == "productoscatalogo" || $seccion == "buscador" || $seccion == "inicio") { ?>

                  <form action="index.php?sec=buscador" method="post">
                    <div class="input-group d-flex">

                      <input type="text" class="buscador form-control" placeholder="Buscar" aria-label="busqueda" aria-describedby="buttonBusq" id="busqueda" name="busqueda">
                      <button class="btn btn-outline-primary buscador" type="submit" id="buttonBusq"><i class="material-symbols-outlined">search</i></button>

                    </div>
                  </form>

                <?php } ?>
                </li>
            </ul>



          </div>


          <span class="navbar-text d-flex">

            <a class="<?= $userData ? "d-none" : "" ?> d-flex" href="index.php?sec=login">
              <i class="material-symbols-outlined"> person </i>
              Inicia sesión
            </a>

            <?PHP if ($userData) { ?>

              <a class="bg-outline-warning rounded me-2 d-flex" href="index.php?sec=panelusuario">
                <i class="material-symbols-outlined"> person </i>
                <?= $userData['nombre_completo'] ?? "" ?>
              </a>

              <a class="me-2 d-flex" href="index.php?sec=carrito">
                <i class="material-symbols-outlined"> shopping_cart </i>
              </a>

            <?PHP } ?>

            <a class="<?= $userData ? "" : "d-none" ?>" href="admin/actions/aut_logout_acc.php">
              Cerrar sesión
            </a>



          </span>

        </div>
      </div>
      </div>

    </nav>

    <h1 class="display-1"> <span lang="en"> Vecchio </span> </h1>




  </header>

  <main class="container text-center">

    <?php

    // Imprimo la vista
    require_once "views/$vista.php";

    ?>

    <div class="toast align-items-center position-fixed bottom-0 start-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000">
      <div class="d-flex">
        <div class="toast-body">
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>

  </main>

  <footer class="container-fluid mt-5  px-5 pt-3 bg-black text-white text-center">
    <div class=" container m-auto row">
      <div class="col-12 col-lg-4 d-lg-flex flex-row mb-5 text-lg-start">
        <div class="flex-column mb-2 mx-md-4">
          <img src="./imagenes/sobreNosotras/Imagencv.jpg" alt="Mujer sonríe a la camara, foto retrato" class="img-fluid rounded">
        </div>
        <div class="flex-column">
          <h2 class="fs-5">María Florencia Rossi</h2>
          <p> 32 años / maria.rossi@davinci.edu.ar </p>
          <div class="iconos">
            <a href="https://www.linkedin.com/in/mar%C3%ADa-florencia-rossi/" target="_blank" class="text-black"> <img src="./imagenes/iconos/linkedin.svg" alt="Icono de Linkedin"> </a>
            <a href="https://www.behance.net/flor-rossi" target="_blank" class="text-black"> <img src="./imagenes/iconos/behance.svg" alt="Icono de Behance"> </a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4 text-lg-center">
        <h2 class="fs-5">Ver más</h2>
        <ul class="list-unstyled">
          <li>
            <a href="./index.html" class=" nav-link active"> Inicio </a>
          </li>
          <li>
            <a href="./paginas/comocomprar.html" class="nav-link"> Cómo comprar </a>
          </li>
          <li>
            <a href="./paginas/shoponline.html" class="nav-link"> Shop online </a>
          </li>
          <li>
            <a href="./paginas/contacto.html" class="nav-link"> Contacto </a>
          </li>
        </ul>
      </div>

      <div class="col-12 col-md-6 col-lg-4 text-lg-center">
        <h2 class="fs-5">Nuestros oldies</h2>
        <ul class="list-unstyled">
          <li>Musicales</li>
          <li>Electro</li>
          <li>Muebles</li>
          <li>Rodados</li>
        </ul>
      </div>

    </div>

  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>