<?php
namespace Catalogo;

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
                'Catalogo\Form\Categoria' => function ($sm) {
                    return new Form\Categoria();
                },
                'Catalogo\Service\Categoria' => function ($sm) {
                    return new Service\Categoria($sm->get('Doctrine\ORM\EntityManager'), $sm);
                },
                'Catalogo\Form\Marca' => function ($sm) {
                    return new Form\Marca();
                },
                'Catalogo\Service\Marca' => function ($sm) {
                    return new Service\Marca($sm->get('Doctrine\ORM\EntityManager'), $sm);
                },
                'Catalogo\Form\Veiculo' => function ($sm) {
                    return new Form\Veiculo($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Catalogo\Service\Veiculo' => function ($sm) {
                    return new Service\Veiculo($sm->get('Doctrine\ORM\EntityManager'), $sm);
                },
            )
        );
    }
}
