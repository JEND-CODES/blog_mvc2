<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

// Appel au RepositoryConnect pour afficher le nom de l'utilisateur en cours
$repositoryConnect = new RepositoryConnect($bdd);

$connect = $repositoryConnect->selectUser($_SESSION['connect']); 

$repositoryChapter = new RepositoryChapter($bdd);

$repositoryComment = new RepositoryComment($bdd);

if(!empty($_POST['delete']))
{
    extract($_POST);    
    
    $repositoryChapter->deleteChapter($edit);

    $supprime = 'Chapitre supprimé';     
}

$chapters = $repositoryChapter->selectChapters();

// Décompte du nombre de commentaires signalés
$alarmComments = $repositoryComment->countAlarmComments();

// Décompte total du nombre de commentaires
$alarmComments3 = $repositoryComment->countAlarmComments2();


require_once('views/viewConnect.php');