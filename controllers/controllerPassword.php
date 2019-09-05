<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

$repositoryConnect = new RepositoryConnect($bdd);

$connect = $repositoryConnect->selectUser($_SESSION['connect']);

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();
    
    $password = htmlentities($password);
    
    $password2 = htmlentities($password2);
    
    $checkpwd2 = htmlentities($checkpwd2);

    if(empty($password))
        array_push($errors, 'Entrez le mot de passe actuel');
    
    if(!empty($password) && sha1($password) != $connect->password())
        array_push($errors, 'Mot de passe actuel inexact');
    
    if(empty($password2))
        array_push($errors, 'Nouveau mot de passe manquant');

    if(!empty($password2) && strlen($password2)>15)
        array_push($errors, 'Nouveau mot de passe trop long');

    if($checkpwd2 != $password2)
        array_push($errors, 'Champ de confirmation inexact');

    if(count($errors) == 0)
    { 
        $connect->setPassword(sha1($password2));
        
        $repositoryConnect->updatePassword($connect);

        $nouveau = 'Mot de passe modifié';

        unset($password);
        unset($password2);
        unset($checkpwd2);
    }
}

require_once('views/viewPassword.php');