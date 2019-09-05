<?php
class Comment
{
    private $_id;
    private $_email;
    private $_chapterId;
    private $_pseudo;
    private $_comment;
    private $_alarm;
    private $_commentDate;
    
    
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    
    
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }
    
    
    public function id()
    {
        return $this->_id;   
    }
    public function email()
    {
        return $this->_email;   
    }
    public function chapterId()
    {
        return $this->_chapterId;   
    }
    public function pseudo()
    {
        return $this->_pseudo;   
    }
    public function comment()
    {
        return $this->_comment;   
    }
    public function alarm()
    {
        return $this->_alarm;   
    }
    public function commentDate()
    {
        return $this->_commentDate;   
    }
    
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if($id > 0)
            $this->_id = $id;
    }
    
    public function setEmail($email)
    {
        if(is_string($email))
            
            $this->_email = $email;
    }
    
    public function setChapterId($chapterId)
    {
        $chapterId = (int) $chapterId;
        
        if($chapterId > 0)
            $this->_chapterId = $chapterId;
    }
    public function setPseudo($pseudo)
    {
        if(is_string($pseudo))
            $this->_pseudo = $pseudo;
    }
    public function setComment($comment)
    {
        if(is_string($comment))
            $this->_comment = $comment;
    }
    public function setAlarm($alarm)
    {
        $alarm = (int) $alarm;
        
        if($alarm >= 0)
            $this->_alarm = $alarm;
    }
    public function setCommentDate($commentDate)
    {
        $this->_commentDate = $commentDate;
    }
}