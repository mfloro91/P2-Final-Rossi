<?PHP
require_once '../functions/autoload.php';


$secciones_validas = [
  "dashboard" => [
    "titulo" => "Panel de Administración",
    "restringido" => TRUE
  ], "comprasrealizadas" => [
    "titulo" => "Historial de ventas",
    "restringido" => TRUE
  ],"admin_producto" => [
    "titulo" => "Administración de Productos",
    "restringido" => TRUE
  ], "admin_material" => [
    "titulo" => "Administración de Materiales",
    "restringido" => TRUE
  ], "admin_origen" => [
    "titulo" => "Administración de Lugar de Origen",
    "restringido" => TRUE
  ], "admin_categoria" => [
    "titulo" => "Administración de Categorías",
    "restringido" => TRUE
  ], "add_origen" => [
    "titulo" => "Agregar un lugar de Origen",
    "restringido" => TRUE
  ], "add_producto" => [
    "titulo" => "Agregar un Producto",
    "restringido" => TRUE
  ], "add_material" => [
    "titulo" => "Agregar un Material",
    "restringido" => TRUE
  ], "add_categoria" => [
    "titulo" => "Agregar una Categoría",
    "restringido" => TRUE
  ], "edit_categoria" => [
    "titulo" => "Editar una Categoría",
    "restringido" => TRUE
  ], "edit_origen" => [
    "titulo" => "Editar un lugar de origen",
    "restringido" => TRUE
  ], "edit_material" => [
    "titulo" => "Editar un material",
    "restringido" => TRUE
  ], "edit_producto" => [
    "titulo" => "Editar un producto",
    "restringido" => TRUE
  ], "delete_categoria" => [
    "titulo" => "Eliminar una Categoría",
    "restringido" => TRUE
  ], "delete_material" => [
    "titulo" => "Eliminar un Material",
    "restringido" => TRUE
  ], "delete_origen" => [
    "titulo" => "Eliminar un Origen",
    "restringido" => TRUE
  ], "delete_producto" => [
    "titulo" => "Eliminar un Producto",
    "restringido" => TRUE
  ], "login" => [
    "titulo" => "Inicia sesión",
    "restringido" => FALSE
  ]
];

$seccion = $_GET['sec'] ?? "dashboard";

if (!array_key_exists($seccion, $secciones_validas)) {
  $vista = "404";
  $titulo = "Error 404";
} else {
  $vista = $seccion;

  if ($secciones_validas[$seccion]['restringido']) {
    Autenticacion::verify();
  }

  $titulo = $secciones_validas[$seccion]['titulo'];
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
  <link rel="stylesheet" href="../estilos/estilo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="icon" type="imagenes/svg" href="../imagenes/marca/logo.svg">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,200,0,0" />
</head>

<body class="body-panel">

  <header class="container-fluid text-center mt-4">

    <nav class="container-fluid navbar navbar-expand-lg sticky-top mb-3">

      <div class="container m-auto">

        <a class="navbar-brand marca fw-bolder fs-2 admin" href="../index.php?sec=inicio">
          <img src="../imagenes/marca/logolargo.svg" alt="Logo" class="d-inline-block align-text-middle ">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" data-bs-theme="dark" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=admin_producto">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=admin_categoria">Categorías</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=admin_material">Materiales</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=admin_origen">Origen</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?sec=comprasrealizadas">Ver ventas</a>
            </li>
          </ul>

          <span class="navbar-text d-flex">

            <a class="<?= $userData ? "d-none" : "" ?> d-flex" href="../index.php?sec=login">
              <i class="material-symbols-outlined"> person </i>
              Inicia sesión
            </a>

            <?PHP if ($userData) { ?>

              <a class="bg-outline-warning rounded me-2 d-flex" href="../index.php?sec=panelusuario">
                <i class="material-symbols-outlined"> person </i>
                <?= $userData['nombre_completo'] ?? "" ?>
              </a>

            <?PHP } ?>

            <a class="<?= $userData ? "" : "d-none" ?>" href="actions/aut_logout_acc.php">
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

    <?PHP

    //Verifiquemos que el archivo exista.
    require_once file_exists("views/$vista.php") ? "views/$vista.php" : "views/404.php";

    ?>
  </main>



  <footer class="container-fluid mt-5  px-5 pt-3 bg-black text-white text-center">
    <div class=" container m-auto row">
      <div class="col-12 col-lg-4 d-lg-flex flex-row mb-5 text-lg-start">
        <div class="flex-column mb-2 mx-md-4">
          <img src="../imagenes/sobreNosotras/Imagencv.jpg" alt="Mujer sonríe a la camara, foto retrato" class="img-fluid rounded">
        </div>
        <div class="flex-column">
          <h2 class="fs-5">María Florencia Rossi</h2>
          <p> 32 años / maria.rossi@davinci.edu.ar </p>
          <div class="iconos">
            <a href="https://www.linkedin.com/in/mar%C3%ADa-florencia-rossi/" target="_blank" class="text-black"> <img src="../imagenes/iconos/linkedin.svg" alt="Icono de Linkedin"> </a>
            <a href="https://www.behance.net/flor-rossi" target="_blank" class="text-black"> <img src="../imagenes/iconos/behance.svg" alt="Icono de Behance"> </a>
          </div>
        </div>
      </div>


    </div>

  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>

</html>