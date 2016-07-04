<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonCliente for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace User;

return array(
    'router' => array(
        'routes' => array(
            'user-register' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/register',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Index',
                        'action' => 'register',
                    )
                )
            ),
            'user-activate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/register/activate[/:key]',
                    'defaults' => array(
                        'controller' => 'User\Controller\Index',
                        'action' => 'activate'
                    )
                )
            ),
            'user-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'index'
                    )
                )
            ),
            'user-recover' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/recover',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'recover'
                    )
                )
            ),
            'user-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Auth',
                        'action' => 'logout'
                    )
                )
            ),
            'user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller' => 'Manager',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(

//                    'list' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:action[/:categoria[/:refid]]]',
//                            'constraints' => array(
//                                '__NAMESPACE__' => 'User\Controller',
//                                'controller' => 'Listar',
//                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'categoria'  => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'refid'      => '[0-9]*',
//                            ),
//                            'defaults' => array(
//                                '__NAMESPACE__' => 'User\Controller',
//                                'controller' => 'Listar',
//                                'action'     => 'index',
//                            ),
//                        ),
//                    ),
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:refid]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'refid' => '[0-9]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'User\Controller\Index' => 'User\Controller\IndexController',
            'User\Controller\Manager' => 'User\Controller\ManagerController',
//            'User\Controller\Users' => 'User\Controller\UsersController',
            'User\Controller\Auth' => 'User\Controller\AuthController',
        )
    ),
    'service_manager' => array(
        'invokables' => array(
//            'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
        ),
        'factories' => array(
            'AuthService' => function () {
                $auth = new \Zend\Authentication\AuthenticationService;
                $auth->setStorage(new \Zend\Authentication\Storage\Session("Auth"));
//                    $authServiceManager = new \User\View\Helper\UserIdentity('AuthService');//\Zend\Authentication\AuthenticationService();
//                var_dump($auth);
                return $auth;
            },
        )),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/user' => __DIR__ . '/../view/layout/layout-user.phtml',
            'layout/funcionario' => __DIR__ . '/../view/layout/layout-funcionario.phtml',
            'layout/admin' => __DIR__ . '/../view/layout/layout-admin.phtml',

            'partials/navigation' => __DIR__ . '/../view/partials/navigation.phtml',

            'partials/content_temp' => __DIR__ . '/../view/partials/content-temp.phtml',
            'partials/header' => __DIR__ . '/../view/partials/header.phtml',
            'partials/header-admin' => __DIR__ . '/../view/partials/header-admin.phtml',
            'partials/header-funcionario' => __DIR__ . '/../view/partials/header-funcionario.phtml',
            'partials/header-user' => __DIR__ . '/../view/partials/header-user.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'error/403' => __DIR__ . '/../view/error/403.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
//    'viever' => array(
//        'UserIdentity' => function () {
//        return new \User\View\Helper\UserIdentity());
//}
    // Placeholder for console routes
    'console' => array(
    'router' => array(
        'routes' => array(),
    ),
),

    'doctrine' => array(
    'driver' => array(
        __NAMESPACE__ . '_driver' => array(
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
        ),
        'orm_default' => array(
            'drivers' => array(
                __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
            ),
        ),
    ),
//            'fixture' => array(__NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture')
),
//        'data-fixture' => array(
//            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
//        ),

);
