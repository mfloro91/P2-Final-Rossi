<?php

$datos = $_POST;
$categoriasSeleccionadas;

//echo "<pre>";
//print_r($datos);
//echo "</pre>";

?>


<div class="p-5 sectionGracias">
    <h2> ¡Gracias por tu contacto <?= $datos["nombre"] ?>! </h2>

    <p> Estos son algunos de los productos que podés ofrecernos: </p>

    <?php foreach ($datos as $parametro => $valor) {

        if ($parametro !== "nombre" && $parametro !== "email") {
            $categoriasSeleccionadas[] = $valor;
        }
    };

    foreach ($categoriasSeleccionadas as $valor) {

    ?>

        <ul>
            <li> <?= $valor ?> </p>
            </li>
        </ul>

    <?php } ?>


    <p>Nos comunicaremos con vos a la brevedad.</p>
</div>