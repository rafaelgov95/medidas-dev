<?php
namespace Cliente;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {

        return array(
            'factories' => array(
//                'auth_service' => function ($sm) {
//                        $authService = new AuthenticationService(new SessionStorage('auth'));
////    				$authService->setStorage(new SessionStorage('auth'));
//                        return $authService;
//                },
                'Cliente\Form\Cliente' => function ($sm) {
//                        $em = $sm->get('Doctrine\ORM\EntityManager');
//                        $repo = $em->getRepository('Atleta\Entity\Teste');
//                        $parent = $repo->fetchParent();

                    return new Form\Cliente(/*$sm->get('Doctrine\ORM\EntityManager')*/);//'role', array("teste" => $parent));
                },
                'Cliente\Service\Cliente' => function ($sm) {
                    return new Service\Cliente($sm->get('Doctrine\ORM\EntityManager'), $sm);
                },
//                'Atleta\Service\Result' => function ($sm) {
//                    return new Service\Result($sm->get('Doctrine\ORM\EntityManager'), $sm);
//                },
//                'User\Auth\Adapter' => function ($sm) {
//                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
//                },
//                'UserIdentity' => function() {
//                        return new \User\View\Helper\UserIdentity();
//                    }


            )
        );
    }
}
