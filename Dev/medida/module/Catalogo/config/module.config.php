<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonCatalogo for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Catalogo;

return array(
    'router' => array(
        'routes' => array(
//            'home' => array(
//                'type' => 'Literal',
//                'options' => array(
//                    'route' => '/catalogo',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Catalogo\Controller',
//                        'controller' => 'Index',
//                        'action' => 'index',
//                    ),
//                ),
//            ),
            'catalogo' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/catalogo',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Catalogo\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(

                    'default1' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:categoria[/:refid]]]]',
                            'constraints' => array(
                                '__NAMESPACE__' => 'Catalogo\Controller',
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'categoria' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'refid' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Catalogo\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:refid]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'refid' => '[0-9]+',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Catalogo\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'search' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action][/:refid][/page][/:page][/q]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z0-9_-]*',
                                'action' => 'index',//[a-zA-Z][a-zA-Z0-9_-]*
                                'page' => '[0-9]+',
                                'refid' => '[0-9]+',
//                                'q' => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ),
//                            'route'    => '/[:controller[/:action][/:id][/page/:page][/order_by/:order_by][/:order][/search/:search]]',
                            //'/album[/:action][/:id][/page/:page][/order_by/:order_by][/:order][/search_by/:search_by]',
//                            'constraints' => array(
//                                'action'    => '(?!\bpage\b)(?!\border_by\b)(?!\bsearch_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
//                                'id'     => '[0-9]+',
//                                'page' => '[0-9]+',
//                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'order' => 'ASC|DESC',
//                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Catalogo\Controller',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Catalogo\Controller\Index' => 'Catalogo\Controller\IndexController',
//            'Catalogo\Controller\Listar' => 'Catalogo\Controller\ListarController',
//            'Catalogo\Controller\Manage' => 'Catalogo\Controller\ManageController',
            'Catalogo\Controller\Categoria' => 'Catalogo\Controller\CategoriaController',
            'Catalogo\Controller\Marca' => 'Catalogo\Controller\MarcaController',
            'Catalogo\Controller\Veiculo' => 'Catalogo\Controller\VeiculoController',
//            'Catalogo\Controller\Teste' => 'Catalogo\Controller\TesteController',
        ),
        'factories' => array(
            'Catalogo\Controller\Teste' => function ($sm) {
                return new Controller\TesteController($sm->getServiceLocator()->get('Catalogo\Plugins\Uploads\FilesService'));
            }
        )
    ),
    'translator' => array(
        'locale' => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Catalogo\Plugins\Uploads\FilesOptions' => function ($sm) {
                $config = $sm->get('Config');
                return new Plugins\Uploads\FilesOptions(isset($config['files']) ? $config['files'] : array());
            },
            'Catalogo\Plugins\Uploads\FilesService' => function ($sm) {
                $options = $sm->get('Catalogo\Plugins\Uploads\FilesOptions');
                return new Plugins\Uploads\FilesService($options);
            },
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        )
    ),
    'files' => array(
        'base_path' => 'files',
        'max_size' => '1536MB'
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
//            'partials/navigation' => __DIR__ . '/../view/partials/navigation.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy'
        )

    ),
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
