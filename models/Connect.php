<?php
class Connect
{
    private $_id;
    private $_user;
    private $_password;
    
    
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
    public function user()
    {
        return $this->_user;     
    }   
    public function password()
    {
        return $this->_password;    
    }   
    
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if($id > 0)
            $this->_id = $id;
    }
    public function setUser($user)
    {
        if(is_string($user))
            $this->_user = $user;
    }
    public function setPassword($password)
    {
        $this->_password = $password;
    }
}