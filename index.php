<?php
// La page Index sert de router 
// La page Index sert aussi de chargement des classes Models 
//Le fichier index.php sert principalement à opérer les redirections pour le bon fonctionnement du blog

//dirname — Renvoie le chemin du dossier parent
define('ROOT', dirname(__FILE__));
// "define root dirname.." signifie "donne moi l'URL du fichier"
// "ROOT" signifie le dossier qui contient toute l'application
$self = htmlentities($_SERVER['PHP_SELF']);

// "define URL.." permet de définir le chemin de la racine 
// Ici le str_replace remplace masque la mention index.php en page d'accueil du site
define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$self"));
//$_SERVER est un tableau contenant des informations comme les en-têtes, dossiers et chemins du script

// PHP ne sait pas qu'il doit appeler une fonction lorsqu'on essaye d'instancier une classe non déclarée. On va donc utiliser la fonction spl_autoload_register en spécifiant en premier paramètre le nom de la fonction à charger //cf.tuto OpenC https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666060-utiliser-la-classe //Les classes sont chargées dynamiquement avec la fonction spl_autoload_register


spl_autoload_register(function($class){
    require('models/' .$class. '.php');
});

require_once('models/Database.php');

?>

<?php
try
{
   
    //Appel des pages du fichiers controllers
    //Contrôle l'affichage des pages
    
    if(isset($_GET['action']))
    {
        if(file_exists('controllers/controller' . ucfirst($_GET['action']) . '.php')) //https://www.php.net/manual/fr/function.ucfirst.php
            require_once('controllers/controller' . ucfirst($_GET['action']) . '.php');
        else
            throw new Exception('');
    }
    else
        require_once('controllers/controllerHome.php');
}

// En cas d'erreurs..

//Une exception est une erreur que l'on peut attraper grâce aux mots-clé try et catch //Une exception se lance grâce au mot-clé throw.


catch(Exception $e)
{
    $errorMsg = $e->getMessage();
    
    //on utilise la fonction require_once pour éviter de recharger plusieurs fois le même fichier
    require_once('views/viewError.php');
}

?>



