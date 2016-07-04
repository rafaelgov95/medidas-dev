<?php

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Validator\Authentication,
    Zend\Authentication\Storage\Session as SessionStorage,
    Zend\Session\SessionManager;

/**
 * Class UserIdentity
 * @package User\View\Helper
 */
class UserIdentity extends AbstractHelper
{// implements \Zend\Authentication\ServiceManagerAwareInterface {

    /**
     * @var
     */
    protected $authService;

    /**
     * @return mixed
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     *
     */
    public function __construct()
    {
//        $this->authService = $authService;
//        $this->authService = new \Zend\Authentication\AuthenticationService();
//        $sessionStorage = new \Zend\Authentication\Storage\Session($namespace);
//        $this->getAuthService()->setStorage($sessionStorage);
//
////        $this->authService = $this->authService->clearIdentity();
//        if (NULL === $this->getAuthService()->getIdentity()) {
//            $this->getAuthService()->clearIdentity();
//
//        } else if ($this->getAuthService()->hasIdentity()) {
//            return $this->authService;
//        }
    }


    /**
     * //     * @param string $namespace
     * @return AuthenticationService
     */
    public function __invoke($namespace = 'Auth')
    {
//        $this->authService = $authService;
        $this->authService = new \Zend\Authentication\AuthenticationService();
        $sessionStorage = new \Zend\Authentication\Storage\Session($namespace);
//        $this->authService->setAdapter(new \User\Auth\Adapter);
        $this->authService->setStorage($sessionStorage);
//        var_dump($this->authService->getIdentity()['user']);

//        $this->authService = $this->authService->clearIdentity();
//        if(NULL === $this->authService->getIdentity()['user']){
//            $this->getAuthService()->clearIdentity();

        if ($this->authService->hasIdentity()) {
            return $this->authService->getIdentity()['user'];
        } else {
            return false;
        }
    }

    /**
     *
     */
    public function getConfig()
    {
        echo $this->authService->getStorage()->read();
    }

}
