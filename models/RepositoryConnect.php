<?php
class RepositoryConnect
{
    private $_bdd;
    
    // CONSTRUCTEUR
    public function __construct($bdd)
    {
        $this->setBdd($bdd);
    }
    
    //Sécuriser les données avec le hashage - cf. https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2873202-protegez-les-donnees //https://sql.sh/fonctions/sha1
    
    //SHA1() propose un hash en 160 bits (40 caractères)
    //Dans le langage SQL, la fonction SHA1() permet de chiffrer une chaîne de caractères sous le forme d’une chaîne de 40 caractères hexadécimal. La fonction calcule la somme de vérification SHA 1 de 160 bits comme décrit dans par la RFC 3174 (Secure Hash Algorithm)
    
    //Cette fonction SQL est utilisée couramment pour le hachage de clé ou en tant que fonction de cryptographie pour stocker un mot de passe.
    
    //A noter : la fonction SHA1() est une fonction de cryptographie plus sûre que la fonction MD5()
    
    // Fonction utilisée aussi pour afficher le nom de l'utilisateur en cours
    public function selectUser($user)
    {        
        $req = $this->_bdd->prepare('SELECT id, user, password FROM managers WHERE user= ?');
        $req->execute(array($user));
         //https://www.php.net/manual/fr/pdostatement.rowcount.php
        // La méthode "rowCount() == 1" vérifie la correspondance à l'ID demandé (Idem pour ID d'un chapitre)
        //PDOStatement::rowCount — Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute()
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            //PDOStatement::fetch = Récupère une ligne depuis un jeu de résultats
            //PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats
            return new Connect($data);   
        }
        $req->closeCursor();        
    }
   
    public function checkUser($user, $password)
    {        
        $req = $this->_bdd->prepare('SELECT id FROM managers WHERE user= ? AND password = ?');
        $req->execute(array($user, sha1($password)));
        if($req->rowCount() == 1)
        {
            return true; 
        }
        $req->closeCursor();
    }
    
    // Mise à jour du mot de passe en fonction de l'utilisateur en cours
    public function updatePassword($connect)
    {
        $req = $this->_bdd->prepare('UPDATE managers SET password = ? WHERE user = ?');
        $req->execute(array($connect->password(), $connect->user()));
        $req->closeCursor(); 
    }
    
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}
