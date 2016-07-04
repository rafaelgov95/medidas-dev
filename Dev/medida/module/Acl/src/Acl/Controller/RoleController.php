<?php

namespace Acl\Controller;

use Base\Controller\CrudController;
use Zend\View\Model\ViewModel;

class RoleController extends CrudController
{

    public function __construct() {
        $this->entity = 'Acl\Entity\Role';
        $this->service = 'Acl\Service\Role';
        $this->form = 'Acl\Form\Role';
        $this->controller = 'role';
        $this->route = 'acl/default';
    }
    
    public function testeAction()
    {
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");
        echo $acl->isAllowed("","ver","-")? "Permitido" : "Negado";die;
    }
}
