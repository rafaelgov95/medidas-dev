<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletoncliente for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Cliente;

return array(
    'router' => array(
        'routes' => array(
            'cliente' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cliente',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cliente\Controller',
                        'controller'    => 'Manager',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(

//                    'list' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:action[/:categoria[/:refid]]]',
//                            'constraints' => array(
//                                '__NAMESPACE__' => 'cliente\Controller',
//                                'controller' => 'Listar',
//                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'categoria'  => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'refid'      => '[0-9]*',
//                            ),
//                            'defaults' => array(
//                                '__NAMESPACE__' => 'cliente\Controller',
//                                'controller' => 'Listar',
//                                'action'     => 'index',
//                            ),
//                        ),
//                    ),
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:refid]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'refid' => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cliente\Controller\Index' => 'Cliente\Controller\IndexController',
            'Cliente\Controller\Manager' => 'Cliente\Controller\ManagerController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
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
