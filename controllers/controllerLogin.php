<?php
session_start();

// Si la session est en cours..
if(!empty($_SESSION['connect']))
    
    // Autorisation d'accès au Back Office
    header('Location:'.URL.'connect');

//Voir demo https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();
    
    // Sécurisation contre injections
    
    $user = htmlentities($user);
    
    $password = htmlentities($password);

    if(empty($user))
        array_push($errors, 'Identifiant manquant');

    if(empty($password))
        array_push($errors, 'Mot de passe manquant');

    
    if(!empty($user) && !empty($password))
    { 
        $repositoryConnect = new RepositoryConnect($bdd);
        
        
        if(!$repositoryConnect->checkUser($user, $password))
            array_push($errors, 'Mauvais identifiants');
        else
        {
           
            //Activation de $_SESSION 
            //https://www.php.net/manual/fr/reserved.variables.session.php
            //https://www.php.net/manual/fr/ref.session.php
            $_SESSION['connect'] = $user;
            
            header('Location:'.URL.'connect');
        }
    }
}



require_once('views/viewLogin.php');
