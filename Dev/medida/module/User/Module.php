<?php
namespace User;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\View\Model\ViewModel;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use User\Auth\Adapter as AuthAdapter;


class Module
{


    public function onBootstrap(MvcEvent $e)
    {


        $eventManager = $e->getApplication()->getEventManager();

        $eventManager->getSharedManager()->attach("Zend\Mvc\Controller\AbstractActionController",
            MvcEvent::EVENT_DISPATCH,
            array($this, 'validaAuth'), 200);
        $eventManager->getSharedManager()->attach("Zend\Mvc\Controller\AbstractActionController", MvcEvent::EVENT_DISPATCH_ERROR,
            array($this, 'onDispatchError'), 300);
//        $eventManager->getSharedManager()->attach("*", MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'Dispatch_Error'), -999);

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

    }

    function onDispatchError(MvcEvent $e)
    {
//        echo 'oks';
//        $vm = $e->getViewModel();
//        $vm->setTemplate('error/403');
//        return $vm;
    }

    public function validaAuth(MvcEvent $e)
    {
        $app = $e->getTarget();
//        $app1 = $e->getApplication();
        $debug = false;


        $sm = $e->getApplication()->getServiceManager();
        $auth = $sm->get("AuthService");

//        $target = $e->getTarget();

        $module = substr(get_class($app), 0, strpos(get_class($app), '\\'));

        $controller = $app->getEvent()->getRouteMatch()->getParam('controller');
        $controller = substr($controller, strlen($module . '\\Controller\\'));
        $controller = ucfirst($controller);
        $action = ucfirst($app->getEvent()->getRouteMatch()->getParam('action'));

        $acl = $sm->get("Acl\Permissions\Acl");

        $role = ucfirst("Visitante");

//        var_dump($auth->getIdentity());exit;
        if ($auth->hasIdentity()) {
            $em = $sm->get("Doctrine\ORM\EntityManager");
            $repo = $em->getRepository("\User\Entity\User");
//            $auth->clearIdentity();
//            $user_auth = $auth;
//            var_dump($auth->getIdentity()['user']);

            $user = $repo->findOneBy(array('id' => $auth->getIdentity()['user']));
            $role = ucfirst($user->getRole()->getNome());
//            var_dump($auth->getIdentity());
        }

//        echo $role . '/' . $module . '::' . $controller . '/' . $action.'<br>';
        $acl_result = null;
        try {
            $acl_result = $acl->isAllowed($role, $module . '::' . $controller, $action);
        } catch (\Exception $error) {
            $acl_result = ($role != "Admin") ? false : true;
        }
        //$acl->isAllowed($role, $resource, $privilege);

        if ($debug) {
            echo $role . ' ' . $module . '::' . $controller . ' ' . $action . ' -------- ';
            echo ($acl_result) ? "Acesso permitido" : "Acesso Negado";
//            exit;
        }

        $viewModel = $e->getViewModel();

        if ($auth->hasIdentity() AND $acl_result) {
            return $viewModel->setTemplate('layout/' . (strtolower($role) === "visitante" ? 'layout' : strtolower($role)));
        } elseif (!$acl_result) {

            if (!$auth->hasIdentity()) {
                return $e->getTarget()->redirect()->toUrl("/auth");
            }
//            $eventManager = $app1->getEventManager();
//            $sharedEventManager = $eventManager->getSharedManager();
//            $sharedEventManager->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) {
//                $controller = $e->getTarget(); //controller`s action which triggered event_dispatch
//                $controller->getResponse()->setStatusCode('403');
//                $controller->layout('error/404');
//            }, 1000);
//            return $e->getResponse()->setStatusCode(404);
//            $response = $e->getResponse();
//            $response->setStatusCode(403);

            $baseModel = new ViewModel();
            $baseModel->setTemplate('error/403');
            $baseModel->setVariables(array('error' => 'conteudo'));
            $e->setViewModel($baseModel);
            $e->setResponse($e->getResponse()->setStatusCode(403));
//            $viewModel->setTerminal(true);
//            return $response;
            $viewModel = new ViewModel(array('content' => $baseModel));
            $viewModel->setTemplate('layout/layout');

            $viewModel->setVariable('content', $baseModel);
            return $viewModel;
        }
        return $viewModel->setTemplate('layout/layout');
    }

    public function getConfig()
    {
        date_default_timezone_set('America/Sao_Paulo');
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
//                'AuthService' => function ($sm) {
//                        $authService = new AuthenticationService();
//    				    $authService->setStorage(new SessionStorage('AuthService'));
//                        return $authService;
//                },
                'User\Mail\Transport' => function ($sm) {
                    $config = $sm->get('Config');

                    $transport = new SmtpTransport;
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);

                    return $transport;
                },
                'User\Service\User' => function ($sm) {
                    return new Service\User($sm->get('Doctrine\ORM\EntityManager'),
                        $sm->get('User\Mail\Transport'),
                        $sm->get('View'));
                },
                'User\Auth\Adapter' => function ($sm) {
                    return new Auth\Adapter($sm->get('Doctrine\ORM\EntityManager'));
                },
                'User\Form\User' => function ($sm) {
//                        $em = $sm->get('Doctrine\ORM\EntityManager');
//                        $repo = $em->getRepository('\Acl\Entity\Role');
//                        $options = $repo->fetchParent();
//                        $options = array();
                    return new Form\User();
                },
//                'Acl\Service\Role' => function ($sm) {
//                        return new \Acl\Service\Role($sm->get('Doctrine\ORM\EntityManager'), $sm);
//                    },

//                'UserIdentity' => function() {
//                    return new \User\View\Helper\UserIdentity();
//                }
            )
        );

    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'UserIdentity' => '\User\View\Helper\UserIdentity'
            ),
            'factories' => array(
//                'AuthServiceWidget' => function ($sm) {
//                    $locator = $sm->getServiceLocator();
//                    $viewHelper = new View\Helper\UserIdentity;
//                    $viewHelper->setAuthService($locator->get('Auth'));
//                    return $viewHelper;
//                }
//                'UserIdentity' => function ($sm) {
////                    '\User\View\Helper\UserIdentity'
////                    return new Auth\Adapter($sm->get('Doctrine\ORM\EntityManager'));
//                    $auth = $sm->get('AuthService');
//                    var_dump($auth );
//                    return $auth;
//                }
            )
        );
    }
//}

}
