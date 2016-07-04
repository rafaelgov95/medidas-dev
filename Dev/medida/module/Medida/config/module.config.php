<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonMedida for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Medida;


return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /medida/:controller/:action
            'medida' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/medida',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Medida\Controller',
                        'controller' => 'medida',
                        'action' => 'index',
                        'order' => 'oficio',
                        'page' =>'1'
//                        'page' => $this->page,
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:refid]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'refid'         => '[0-9]*'
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'search1' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:refid][/page[/:page]][/order[/:order[/orderby[/:orderby]]]]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',//[a-zA-Z][a-zA-Z0-9_-]*
                               'page' => '[0-9]+',
                                'refid' => '[0-9]+',
                                'order' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'orderby' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'q' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Medida\Controller',
                                'controller'    => 'Medida',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/refid/:refid][/page/:page][/order/:order][/orderby/:orderby]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',//[a-zA-Z][a-zA-Z0-9_-]*
                                'page' => '[0-9]+',
                                'refid' => '[0-9]+',
                                'order' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'orderby' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'q' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Medida\Controller',
                                'controller'    => 'Medida',
                                'action'        => 'index',
                               // 'page' => 'refid',
                                //'refid' => '[0-9]+',
                            ),
                        ),
                    ),

                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AuthService' => function () {
                $auth = new \Zend\Authentication\AuthenticationService;
                $auth->setStorage(new \Zend\Authentication\Storage\Session("Auth"));
             //       $authServiceManager = new \User\View\Helper\UserIdentity('AuthService');//\Zend\Authentication\AuthenticationService();
                var_dump($auth);
                return $auth;
            },
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Medida\Controller\Index' => 'Medida\Controller\IndexController',
            'Medida\Controller\Medida' => 'Medida\Controller\MedidaController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'medida/index/index' => __DIR__ . '/../view/medida/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
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
