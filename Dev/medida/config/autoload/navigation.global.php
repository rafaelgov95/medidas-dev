 <?php

 return ['navigation' => [

                    'default' => [
[
                    'label' => 'Medida',
                    'route' => 'medida/default',
                    'controller' => 'medida',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Medida',
                                    'controller' => 'Medida',
                                    'route' => 'medida/default',
                                ],[
                                    'action' => 'Remover',
                                    'label' => 'Remover',
                                    'controller' => 'Medida',
                                    'route' => 'medida/default',
                                ],]
                ],[
                    'label' => 'User',
                    'route' => 'user/default',
                    'controller' => 'index',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'user/default',
                                ],[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'user/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Index',
                                    'route' => 'user/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Index',
                                    'route' => 'user/default',
                                ],[
                                    'action' => 'Detalhe',
                                    'label' => 'Perfil',
                                    'controller' => 'Index',
                                    'route' => 'user/default',
                                ],]
                ],[
                    'label' => 'Cliente',
                    'route' => 'cliente/default',
                    'controller' => 'index',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],[
                                    'action' => 'Detalhe',
                                    'label' => 'Detalhe',
                                    'controller' => 'Index',
                                    'route' => 'cliente/default',
                                ],]
                ],[
                    'label' => 'Veiculo',
                    'route' => 'catalogo/default',
                    'controller' => 'veiculo',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Veiculo',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Veiculo',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Veiculo',
                                    'route' => 'catalogo/default',
                                ],]
                ],[
                    'label' => 'Teste',
                    'route' => 'catalogo/default',
                    'controller' => 'teste',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Teste',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Teste',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Teste',
                                    'route' => 'catalogo/default',
                                ],]
                ],[
                    'label' => 'Marca',
                    'route' => 'catalogo/default',
                    'controller' => 'marca',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Marca',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Marca',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Marca',
                                    'route' => 'catalogo/default',
                                ],]
                ],[
                    'label' => 'Categoria',
                    'route' => 'catalogo/default',
                    'controller' => 'categoria',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Categoria',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Categoria',
                                    'route' => 'catalogo/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Categoria',
                                    'route' => 'catalogo/default',
                                ],]
                ],[
                    'label' => 'Catalogo',
                    'route' => 'catalogo/default',
                    'controller' => 'index',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'catalogo/default',
                                ],]
                ],[
                    'label' => 'Roles',
                    'route' => 'acl/default',
                    'controller' => 'role',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Role',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Role',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Role',
                                    'route' => 'acl/default',
                                ],]
                ],[
                    'label' => 'Resources',
                    'route' => 'acl/default',
                    'controller' => 'resource',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Resource',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Resource',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Resource',
                                    'route' => 'acl/default',
                                ],]
                ],[
                    'label' => 'Privileges',
                    'route' => 'acl/default',
                    'controller' => 'privilege',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Privilege',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Inserir',
                                    'label' => 'Novo',
                                    'controller' => 'Privilege',
                                    'route' => 'acl/default',
                                ],[
                                    'action' => 'Editar',
                                    'label' => 'Editar',
                                    'controller' => 'Privilege',
                                    'route' => 'acl/default',
                                ],]
                ],[
                    'label' => 'Acl',
                    'route' => 'acl/default',
                    'controller' => 'index',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'acl/default',
                                ],]
                ],[
                    'label' => 'Inicio',
                    'route' => 'application/default',
                    'controller' => 'index',
                    'pages' => [[
                                    'action' => 'Index',
                                    'label' => 'Listar',
                                    'controller' => 'Index',
                                    'route' => 'application/default',
                                ],]
                ],
]]];
