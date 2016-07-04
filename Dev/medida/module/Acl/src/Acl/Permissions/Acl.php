<?php

namespace Acl\Permissions;

use Zend\Permissions\Acl\Acl as ClassAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends ClassAcl
{

    protected $roles;
    protected $resources;
    protected $privileges;

    public function __construct(array $roles, array $resources, array $privileges)
    {


        $this->roles = $roles;
        $this->resources = $resources;
        $this->privileges = $privileges;

        $this->salvarAcl();

        $this->loadRoles();
        $this->loadResources();
        $this->loadPrivileges();

    }

    protected function loadRoles()
    {
//        echo '<b>Roles</b>' . '<br>';
        foreach ($this->roles as $role) {
            if ($role->getParent()) {
//                echo $role->getNome() . '___' . $role->getParent()->getNome() . '<br>';
                $this->addRole(new Role($role->getNome()), new Role($role->getParent()->getNome()));
            } else {
//                echo $role->getNome() . '<br>';
                $this->addRole(new Role($role->getNome()));
            }
            if ($role->getIsAdmin())
                $this->allow($role->getNome(), array(), array());
        }
    }

    protected function loadResources()
    {
//        echo '<b>Resources</b>'.'<br>';
        foreach ($this->resources as $resource) {
//            echo $resource->getNome() . '<br>';
            $this->addResource(new Resource($resource->getNome()));
        }
    }

    protected function loadPrivileges()
    {
//        echo '<b>Privileges</b>'.'<br>';
        foreach ($this->privileges as $privilege) {
//            echo $privilege->getRole()->getNome() . ' ____' . $privilege->getResource()->getNome() . ' ____' . $privilege->getNome().'<br>';
            $this->allow($privilege->getRole()->getNome(), $privilege->getResource()->getNome(), $privilege->getNome());
        }
    }

    private function salvarAcl()
    {
        $acl = '';
        $acl2 = array();
        $dat = array();
        $dat1 = array();
//        foreach ($this->privileges as $privilege) {

        foreach ($this->resources as $resource) {
            $module = explode('::', $resource->getNome());
            $controller = $module[1];
            $module = $module[0];
            $module = strtolower($module);
            $controller = strtolower($controller);
            $ok1 = 0;
            if (count($dat1, COUNT_RECURSIVE) !== 0) {
                foreach ($dat1 as $d1) {
                    if ($d1 === $resource->getRoute() . '_' . $resource->getLabel()) {
                        $ok1 = 1;
//                        echo 'ok';
                    }
                }
            } else {
                $dat1 = array_merge_recursive(array($resource->getRoute() . '_' . $resource->getLabel()), $dat1);
                $ok1 = 0;
            }

            $acl1 = '';
            $ok = 1;
            foreach ($this->privileges as $privilege) {
                $ok = 0;
                if (count($dat, COUNT_RECURSIVE) !== 0) {
                    foreach ($dat as $d) {
                        if ($d === $privilege->getResource()->getNome() . '_' . $privilege->getLabel())
                            $ok = 1;
                    }
                } else {
                    $dat = array_merge_recursive(array($privilege->getResource()->getNome() . '_' . $privilege->getLabel()), $dat);
                    $ok = 0;
                }

                if ($resource->getLabel() === $privilege->getResource()->getLabel() && $ok === 0) {

                    if ($privilege->isActive()) {
//                        $tmp =
//                            [
//                                [
//                                    'action' => $privilege->getNome(),
//                                    'label' => $privilege->getLabel(),
//
//                                    'route' => $privilege->getResource()->getRoute(),
//                                ]
//                            ];
//                        $acl1 = array_merge_recursive($acl1, $tmp);
                        $tmp = "[
                                    'action' => '". $privilege->getNome()."',
                                    'label' => '".$privilege->getLabel()."',
                                    'controller' => '".ucfirst($controller)."',
                                    'route' => '".$privilege->getResource()->getRoute()."',
                                ],";
                        $acl1 = $acl1 . $tmp;
                        $dat = array_merge_recursive(array($privilege->getResource()->getNome() . $privilege->getLabel()), $dat);
                    }
                }
            }

//

            if ($ok1 === 0) {
//                $arr = [[
//                    'label' => $resource->getLabel(),
//                    'route' => $resource->getRoute(),
//                    'controller' => $controller,
//                    'pages' => $acl1
//                ]];
//                $acl = array_merge_recursive($arr, $acl);
                $arr = "[
                    'label' => '".$resource->getLabel()."',
                    'route' => '".$resource->getRoute()."',
                    'controller' => '".$controller."',
                    'pages' => [".$acl1 ."]
                ],";
                $acl = $arr . $acl;

                $dat1 = array_merge_recursive(array($resource->getRoute() . '_' . $resource->getLabel()), $dat1);
            }

        }
//        echo '<pre>';
//        var_dump($acl);
//        echo '</pre>';
//        exit;
//        }

//        echo '<pre>' . var_export($acl, true) . '</pre>';
        $file = " <?php\n\n return ['navigation' => [\n
                    'default' => [\n" .
            $acl
            . "\n]]];\n";
        file_put_contents('config/autoload/navigation.global.php', $file);
        return false;
    }
}

/*
 *
 * foreach ($this->resources as $resource) {
            foreach ($this->privileges as $privilege) {
                if ($privilege->isActive()) {
                    $tmp = [
                        'label' => $privilege->getResource()->getLabel(),
                        'route' => $privilege->getResource()->getRoute(),
                        'pages' => [
                            'action' => $privilege->getNome(),
                            'label' => $privilege->getLabel(),
                            'route' => $privilege->getResource()->getRoute(),

                        ],
                    ];
                    $acl = array_merge_recursive($acl, $tmp);
                }
            }
        }
 * [
    'navigation' => [
        'default' => [
            [
                'label' => 'Clientes',
                'route' => 'cliente',
                'pages' => [
                    [
                        'label' => 'Listar',
                        'route' => 'cliente/list',
                        'action' => 'list',
                    ],
                    [
                        'label' => 'Novo',
                        'route' => 'cliente/new',
                        'action' => 'new',
                    ],
                ]
            ],
            [
                'label' => 'Produtos',
                'route' => 'produto',
                'pages' => [
                    [
                        'label' => 'Listar',
                        'route' => 'produto/list',
                        'action' => 'list',
                    ],
                    [
                        'label' => 'Novo',
                        'route' => 'produto/new',
                        'action' => 'new',
                    ],
                ]
            ],
        ]
    ],
];
 */