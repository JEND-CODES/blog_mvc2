<?php
class RepositoryChapter
{
    private $_bdd;
    
    public function __construct($bdd)
    {
        //instanciation pour database connexion
        $this->setBdd($bdd);
    }

    //Création de méthodes -> Pour la déclaration de méthodes, il suffit de faire précéder le mot-clé function à la visibilité de la méthode
    
    //CF. Tuto OpenC https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4735671-passage-du-modele-en-objet
    
    //https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4678891-nouvelle-fonctionnalite-afficher-des-commentaires
    
    //Cf. méthode FETCH https://www.php.net/manual/fr/pdostatement.fetch.php
    
    // Récupération de tous les chapitres sous forme d'objets dans un tableau (Array pour l'édition en Back Office)
    public function selectChapters()
    {  
        $chapters = array();
        
        $req = $this->_bdd->query('SELECT id, title, content, chapi, alarm, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS chapterDate, DATE_FORMAT(refreshdate, \'%d/%m/%Y à %Hh %imin %ss\') AS refreshDate FROM chapters ORDER BY id DESC');
        $req->execute();
        
        //La signification d'une boucle while est très simple. PHP exécute l'instruction tant que l'expression de la boucle while est évaluée comme TRUE. La valeur de l'expression est vérifiée à chaque début de boucle, et, si la valeur change durant l'exécution de l'instruction, l'exécution ne s'arrêtera qu'à la fin de l'itération
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        { 
            // PDO::FETCH_ASSOC -> Chaque entrée sera récupérée et placée dans un array
            
            $chapters[] = new Chapter($data);
        }

        return $chapters;
        $req->closeCursor();
        
    }
    
    // Récupération de tous les chapitres (Pour page Accueil) + nombre de caractères limités
    public function selectChapters1()
    {  
        $chapters1 = array();
        
        $req = $this->_bdd->query('SELECT id, title, SUBSTRING(content, 1, 380) AS content, chapi, alarm, zerolink, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS chapterDate FROM chapters ORDER BY id DESC LIMIT 0,3');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $chapters1[] = new Chapter($data);
        }

        return $chapters1;
        $req->closeCursor();
    }
    
    // Récupération de tous les chapitres en ordre inversé (Pour page Sommaire)
    public function selectChapters2()
    {  
        $chapters2 = array();
        
        $req = $this->_bdd->query('SELECT id, title, content, chapi, alarm, zerolink, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS chapterDate FROM chapters ORDER BY id ASC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $chapters2[] = new Chapter($data);
        }
        
        return $chapters2;
        $req->closeCursor();
    }
    
    // Récupération d'un chapitre spécifique (pour affichage en Back Office avec date de mise à jour)
    public function selectChapter($id)
    {
        $req = $this->_bdd->prepare('SELECT id, title, content, chapi, zerolink, alarm, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS chapterDate, DATE_FORMAT(refreshdate, \'%d/%m/%Y à %Hh %imin %ss\') AS refreshDate FROM chapters WHERE id = ?');
        $req->execute(array($id));
        //https://www.php.net/manual/fr/pdostatement.rowcount.php
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Chapter($data);   
        }
        else
            throw new Exception('');

        $req->closeCursor();
    }
    
    // Récupération d'un chapitre spécifique avec format de date modifié (pour affichage page spécifique d'un chapitre)
    public function selectChapter1($id)
    {
        $req = $this->_bdd->prepare('SELECT id, title, content, chapi, alarm, DATE_FORMAT(date, \'%d/%m/%Y\') AS chapterDate FROM chapters WHERE id = ?');
        $req->execute(array($id));
        //https://www.php.net/manual/fr/pdostatement.rowcount.php
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Chapter($data);   
        }
        else
            throw new Exception('');

        $req->closeCursor();
    }
    
    // Ajout d'un chapitre
    public function insertChapter($edit)
    {
        $req = $this->_bdd->prepare('INSERT INTO chapters (title, content, chapi, zerolink, date) VALUES(?, ?, ?, ?, NOW())');
        $req->execute(array($edit->title(), $edit->content(), $edit->chapi(),$edit->zerolink()));
        $req->closeCursor();    
    }
   
    // Mise à jour d'un chapitre (spécifie aussi la date de mise à jour qui ne sera plus valeur NULL par défaut)
    public function updateChapter($chapter)
    {
        $req = $this->_bdd->prepare('UPDATE chapters SET title = ?, content = ?, chapi = ?, zerolink = ?, refreshdate = NOW() WHERE id = ?');
        $req->execute(array($chapter->title(), $chapter->content(), $chapter->chapi(), $chapter->zerolink(), $chapter->id()));
        $req->closeCursor();   
    }
    
    // Pour l'ajout de Likes sur chaque chapitre
    public function alarmChapter($alarm)
    {
        $req = $this->_bdd->prepare('UPDATE chapters SET alarm = alarm+1 WHERE id = ?');
        $req->execute(array($alarm));
        $req->closeCursor();
    }
    
    // Suppression d'un chapitre
    public function deleteChapter($edit)
    {
        $req = $this->_bdd->prepare('DELETE FROM chapters WHERE id = ?');
        $req->execute(array($edit));
        $req->closeCursor();    
    }
    
    // Chapitre suivant
    public function nextChapter($id)
    {
        $req = $this->_bdd->prepare('SELECT id, title FROM chapters WHERE id > ? LIMIT 1');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Chapter($data);   
        }
        $req->closeCursor();
    }
    
    // Chapitre précédent
    public function prevChapter($id)
    {
        $req = $this->_bdd->prepare('SELECT id, title FROM chapters WHERE id < ? ORDER BY id DESC LIMIT 1');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Chapter($data);   
        }
        $req->closeCursor();
    }
    
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}