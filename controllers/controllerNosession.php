<?php
//session_start — Démarre une nouvelle session ou reprend une session existante
//https://www.php.net/manual/fr/function.session-start.php
session_start();

unset($_SESSION['connect']);

//https://www.php.net/manual/fr/function.session-destroy.php
session_destroy();

header('Location:'.URL.'login');

?>