<?php
class RepositoryComment
{
    private $_bdd;
    
    // CONSTRUCTEUR
    public function __construct($bdd)
    {
        $this->setBdd($bdd);
    }
  
    //cf. Tuto OpenC https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4735671-passage-du-modele-en-objet
    
    // Sélection de tous les commentaires
    public function selectComments($chapterId)
    {
        $comments = [];
        
        $req = $this->_bdd->prepare('SELECT id, email, chapter_id, pseudo, comment, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS commentDate FROM comments WHERE chapter_id = ? ORDER BY id ASC');
        $req->execute(array($chapterId)); 
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }
        return $comments;
        $req->closeCursor();
    }
    
    // Sélection des 4 derniers commentaires avec alternance de l'ordre
    public function selectComments2($chapterId)
    {
        $comments2 = [];
        
        $req = $this->_bdd->prepare('SELECT id, email, chapter_id, pseudo, comment, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS commentDate FROM comments WHERE chapter_id = ? ORDER BY id DESC LIMIT 0,5');
        $req->execute(array($chapterId)); 
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $comments2[] = new Comment($data);
        }
        return $comments2;
        $req->closeCursor();
    }
  
    // Ajout d'un commentaire
    public function insertComment($insertcom)
    {
        $req = $this->_bdd->prepare('INSERT INTO comments (email, chapter_id, pseudo, comment, date) VALUES(?, ?, ?, ?, NOW())');
        $req->execute(array($insertcom->email(), $insertcom->chapterId(), $insertcom->pseudo(), $insertcom->comment()));
        $req->closeCursor();
    }
    
     // Suppression d'un commentaire
    public function deleteComment($act)
    { 
        $req = $this->_bdd->prepare('DELETE FROM comments WHERE id = ?');
        $req->execute(array($act));
        $req->closeCursor();
    }
   
    // Signalement d'un commentaire
    public function alarmComment($act)
    {
        $req = $this->_bdd->prepare('UPDATE comments SET alarm = alarm+1 WHERE id = ?');
        $req->execute(array($act));
        $req->closeCursor();
    }
   
    // Sélection de tous les commentaires par ordre décroissant (variable "$alarmComments" utilisée dans controllerCommentaire)
    public function selectAlarmComments()
    {
        $alarmComments = [];
        
        $req = $this->_bdd->prepare('SELECT id, pseudo, comment, alarm, email, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS commentDate FROM comments WHERE alarm > 0 ORDER BY alarm DESC');
        $req->execute(); 
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $alarmComments[] = new Comment($data);
        }
        return $alarmComments;
        $req->closeCursor();        
    }
    
    // Sélection de tous les commentaires par ordre décroissant (variable "$alarmComments2" utilisée dans controllerCommentaire)
    public function selectAlarmComments2()
    {
        $alarmComments2 = [];
        
        $req = $this->_bdd->prepare('SELECT id, pseudo, comment, alarm, email, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS commentDate FROM comments ORDER BY id DESC');
        $req->execute(); 
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $alarmComments2[] = new Comment($data);
        }
        return $alarmComments2;
        $req->closeCursor();        
    }
    
    // Sélection de tous les commentaires par ordre décroissant (variable "$alarmComments3" utilisée dans controllerChapter)
    public function selectAlarmComments3()
    {
        $alarmComments3 = [];
        
        $req = $this->_bdd->prepare('SELECT id, pseudo, comment, alarm, email, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS commentDate FROM comments ORDER BY id DESC');
        $req->execute(); 
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $alarmComments3[] = new Comment($data);
        }
        return $alarmComments3;
        $req->closeCursor();        
    }
    
    // Décompte des commentaires pour chaque chapitre
    public function countComments($chapterId)
    {
        $req = $this->_bdd->prepare('SELECT COUNT(id) FROM comments WHERE chapter_id = ?');
        $req->execute(array($chapterId));
        return $req->fetchColumn();
        $req->closeCursor();        
    }
    
    // Décompte du nombre de commentaires signalés
    public function countAlarmComments()
    {
        $req = $this->_bdd->prepare('SELECT COUNT(id) FROM comments WHERE alarm > 0');
        $req->execute();
        return $req->fetchColumn();
        $req->closeCursor();
    }
    
    // Décompte du nombre total de commentaires (sans tri de signalements)
    public function countAlarmComments2()
    {
        $req = $this->_bdd->prepare('SELECT COUNT(id) FROM comments');
        $req->execute();
        return $req->fetchColumn();
        $req->closeCursor();
    }
  
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}