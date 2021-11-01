<footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
<?php if($_SESSION) : ?>
<?php if($_SESSION['is_admin'] === "1") :?>
    <script src="js/navadmin.js"></script>
<?php endif; ?>
<?php if($_SESSION['is_admin'] === "0") : ?>
    <script src="js/navusuario.js"></script>
<?php endif; ?>
<?php endif; ?>
<?php if(!$_SESSION) : ?>
    <script src="js/nav.js"></script>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/ionicons@5.1.0/dist/ionicons.js"></script>
<script src="https://code.jquery.com/jquery-latest.js"></script>
<script src="js/navv2.js"></script>
</body>
</html>