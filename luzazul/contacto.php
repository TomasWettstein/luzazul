<?php session_start();
require_once("loader.php");
require_once('partials/header.php'); 
?>
<body>
    <?php require_once('partials/nav.php'); ?>
    <h2 class = "-titulo">Contacto</h2>
    <section class = "col-12">
        <ul class  = "col-12">
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/wpp.png" alt="" class = "col-6 offset-3 col-md-4 offset-md-4">
                <h2 class = "text-center text-white">11 3443 7090</h2>
            </li>
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/insta.png" alt="" class = "col-6 offset-3 col-md-4 offset-md-4">
                <h2 class = "text-center text-white">@productosLuzAzul</h2>
            </li>
            <li class = "col-12 col-md-4 offset-md-4 border-top">
                <img src="img/correo.png" alt="" class = "col-6 offset-3 col-md-4 offset-md-4">
                <h2 class = " text-center text-white">jazminepstein.marchi <br>@gmail.com</h2>
            </li>
        </ul>
    </section>
    <?php require_once('partials/footer.php'); ?>