<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

$repositoryComment = new RepositoryComment($bdd);

if(!empty($_POST['delete']))
{
    extract($_POST);
    
    $repositoryComment->deleteComment($act);

    $drop = 'Commentaire supprimé';     
}

$alarmComments = $repositoryComment->selectAlarmComments();

$alarmComments2 = $repositoryComment->selectAlarmComments2();

require_once('views/viewCommentaires.php');