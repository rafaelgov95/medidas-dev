<?php

namespace User\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{
    protected $em;
    protected $id;
    protected $username;
    protected $password;
    protected $role;
    
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function authenticate()
    {
        $repository = $this->em->getRepository("User\Entity\User");
        $_login = $repository->findByloginAndPassword($this->getUsername(),$this->getPassword());
        if($_login)
            return new Result(Result::SUCCESS, array('user'=>$_login),array('OK'));
        else
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
    }


}
