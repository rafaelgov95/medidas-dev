<?php
namespace Base;

class Module
{
//    public function onBootstrap(MvcEvent $event){
////        $application = $event->getApplication();
////        $sharedEventManager = $application->getEventManager()->getSharedManager();/* @var $sharedEventManager \Zend\EventManager\SharedEventManager */
//    }
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
}
