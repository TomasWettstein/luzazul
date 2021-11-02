<?php session_start();
require_once("loader.php");
require_once('partials/header.php'); 
?>
<body>
    <?php require_once('partials/nav.php'); ?>
    <h2 class = "-titulo">Contacto</h2>
    <section class = "col-12">
        <ul class  = "col-12 -lista-contacto">
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/wpp.png" alt="" class = "col-4 offset-4 col-md-4 offset-md-4">
                <h2 class = "text-center -info-contacto">11 3443 7090</h2>
            </li>
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/insta.png" alt="" class = "col-4 offset-4 col-md-4 offset-md-4">
                <h2 class = "text-center -info-contacto">@productosluzazul</h2>
            </li>
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/correo.png" alt="" class = "col-4 offset-4 col-md-4 offset-md-4">
                <h2 class = " text-center -info-contacto">jazminepstein.marchi <br>@gmail.com</h2>
            </li>
        </ul>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <?php require_once('partials/footer.php'); ?>