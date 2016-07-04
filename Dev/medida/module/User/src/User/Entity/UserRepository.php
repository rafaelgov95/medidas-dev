<?php

namespace User\Entity;

use Doctrine\ORM\EntityRepository;
//use User\Service\User as UserService;
use User\Entity\User;
class UserRepository extends EntityRepository
{

//    public function findByLoAndPassword($email, $password)
//    {
//        $user = $this->findOneByEmail($email);
//
//        if($user)
//        {
//            $hashSenha = $user->encryptPassword($password);
//            if($hashSenha == $user->getPassword())
//                return $user;
//            else
//                return false;
//        }
//        else
//            return false;
//    }

    public function findByLoginAndPassword($login, $password)
    {
        $user = $this->findOneByLogin($login);
        if(!$user)
            $user = $this->findOneByEmail($login);

        if($user)
        {
            $hashSenha = $user->encryptPassword($password);
            if($hashSenha == $user->getPassword())
                return $user;
            else
                return false;
        }
        else
            return false;
    }

    public function findArray()
    {
        $users = $this->findAll();
        $a = array();
        foreach($users as $user)
        {
            $a[$user->getId()]['id'] = $user->getId();
            $a[$user->getId()]['login'] = $user->getLogin();
            $a[$user->getId()]['email'] = $user->getEmail();
        }

        return $a;
    }

}
