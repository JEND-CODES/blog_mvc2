<?php

//Connexion à la base de données

//A placer dans le Modèle : cette partie gère les données de votre site. Son rôle est d'aller récupérer les informations « brutes » dans la base de données, de les organiser et de les assembler pour qu'elles puissent ensuite être traitées par le contrôleur. On y trouve donc entre autres les requêtes SQL.

// ajout d'un try catch die pour afficher un message d'erreur lorsque l'on n'est pas connecté à une bdd existante

//On essaie de se connecter à la base de données dans le bloc  try . Si tout va bien, on continue (on va dans le "Code après"). Si en revanche il y a un souci lors de la connexion (à l'intérieur du new PDO), alors on récupère l'erreur dans le bloc catch

try{
    $bdd = new PDO('mysql:host=localhost;dbname=bdd_mvc;charset=utf8', 'root', '');
    
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    //gère le type d'erreurs lors de la connexion à la BDD - l'option ERRMODE_SILENT est l'option par défaut qui assigne simplement les messages d'erreurs (ERRMODE_SILENT - voir la documentation MySQL)
    
}catch(PDOException $e){
    
    die($e->getMessage());
    //la fonction getMessage permet d'indiquer un message d'erreur lorsque l'on n'est pas connecté à une bdd existante
    
}


?>