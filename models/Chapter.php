<?php
class Chapter
{
    
    //Création d'attributs - Pour déclarer des attributs, on va donc les écrire entre les accolades, les uns à la suite des autres, en faisant précéder leurs noms du mot-clé private //Vous pouvez constater que chaque attribut est précédé d'un underscore (« _ »). Ceci est une notation qu'il est préférable de respecter (il s'agit de la notation PEAR) qui dit que chaque nom d'élément privé doit être précédé d'un underscore
    private $_id;
    private $_title;
    private $_content;
    private $_chapi;
    private $_alarm;
    private $_zerolink;
    private $_chapterDate;
    private $_refreshDate;
    
    // constructeur -> Comme son nom l'indique, le constructeur sert à construire l'objet.
    
    //Le constructeur d'une classe a pour rôle principal d'initialiser l'objet en cours de création, c'est-à-dire d'initialiser la valeur des attributs (soit en assignant directement des valeurs spécifiques, soit en appelant diverses méthodes).
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    
    // méthode hydrate - L'hydratation consiste à transformer le contenu d'une base de données en objets // Voir tuto OpenC https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666289-manipulation-de-donnees-stockees
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
            //Il est possible de changer la visibilité d'une méthode ainsi que son nom grâce au mot-clé as.
        {
            
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);
            
            // Si le setter correspondant existe
            // On appelle le setter
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }
    
    //Pour lire ou modifier un attribut, on utilise des accesseurs (getters) et des mutateurs (setters)
    
    // getters
    //lorsque les attributs des objets sont inaccessibles (private et encapsulés dans une classe) -> Il faut créer des getters pour pouvoir les lire, et des setters pour pouvoir modifier leurs valeurs.
    
    //Appeler les méthodes de l'objet - Pour appeler une méthode d'un objet, il va falloir utiliser un opérateur : il s'agit de l'opérateur " -> " 
    public function id()
    {
        return $this->_id;    
    }
    public function title()
    {
        return $this->_title;    
    }
    public function content()
    {
        return $this->_content;    
    }
    public function chapi()
    {
        return $this->_chapi;    
    }
    public function alarm()
    {
        return $this->_alarm;    
    }
    public function zerolink()
    {
        return $this->_zerolink;    
    }
    public function chapterDate()
    {
        return $this->_chapterDate;
    } 
    public function refreshDate()
    {
        return $this->_refreshDate;
    } 
    
    //fonction setId vérifie si l'ID est bien supérieure à zéro (ce qui doit forcément être le cas dans la table SQL)
    public function setId($id)
    {
        $id = (int) $id;
        
        if($id > 0)
            $this->_id = $id;
    }
    //fonction setTitle vérifie s'il s'agit bien d'une chaîne de caractères
    public function setTitle($title)
    {
        if(is_string($title))
            
            // On vérifie qu'il s'agit bien d'une chaîne de caractères
            $this->_title = $title;
    }
    public function setContent($content)
    {
        if(is_string($content))
            $this->_content = $content;
    }
       public function setChapi($chapi)
    {
        if(is_string($chapi))
            $this->_chapi = $chapi;
    }
    public function setAlarm($alarm)
    {
        $alarm = (int) $alarm;
        
        if($alarm >= 0)
            $this->_alarm = $alarm;
    }
    public function setZerolink($zerolink)
    {
        if(is_string($zerolink))
            //Pour affichage image par défault des chapitres
            $this->_zerolink = $zerolink;
    }
    public function setChapterDate($chapterDate)
    {
        $this->_chapterDate = $chapterDate;
    }
    public function setRefreshDate($refreshDate)
    {
        $this->_refreshDate = $refreshDate;
    }
}