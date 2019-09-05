<?php 
$nav_title = "Page introuvable"; 
?>

<?php

if(isset($errorMsg))
{
require_once('views/header.php');
?>

<p id="errors">Adresse url erronée <?= $errorMsg ?> </p>

<br>

<?php
    
require_once('views/footer.php');
}
else
{
    define('ROOT', dirname(__FILE__));
    define('URL', str_replace("views/viewError.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
    require_once(ROOT.'/header.php'); ?>

<p id="errors">Adresse url erronée</p>

<br>

<?php require_once(ROOT.'/footer.php'); 
}
