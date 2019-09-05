<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

if(empty($_GET['id']) OR !is_numeric($_GET['id']))
    throw new Exception('Page introuvable'); 
else
{
    extract($_GET);
    $id = htmlentities($id);

    $repositoryChapter = new RepositoryChapter($bdd);

    $chapter = $repositoryChapter->selectChapter($id); 

    if(!empty($_POST))
    {
        extract ($_POST);
        $errors = array();
        
        $title = htmlentities($title);
        
        $chapi = htmlentities($chapi);
        
        $zerolink = htmlentities($zerolink);
        
        if(empty($title))
            array_push($errors, 'Le titre est manquant');
        
        if(empty($chapi))
            array_push($errors, 'Précisez le numéro du chapitre');

        if(empty($content))
            array_push($errors, 'Le contenu est manquant');

        if(count($errors) == 0)
        { 
            $chapter->setTitle($title);
            $chapter->setContent($content);
            $chapter->setChapi($chapi);
            $chapter->setZerolink($zerolink);

            $repositoryChapter->updateChapter($chapter);

            $checked = 'Chapitre modifié';

            unset($title);
            unset($content);
            unset($chapi);
        }
    }

    require_once('views/viewChange.php');
}