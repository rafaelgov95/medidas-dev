<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Medida\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class MedidaController extends \Base\Controller\CrudController
{

    public function __construct()
    {
        $this->entity = "Medida\Entity\Medida";
        $this->form = "Medida\Form\Medida";
        $this->service = "Medida\Service\Medida";
        $this->controller = "Medida";
        $this->route = "medida/default";
    }

    public function indexAction()
    {
        $auth = $this->getServiceLocator()->get("AuthService");
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");

        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page', 1);

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);


        return new ViewModel(array('data' => $paginator, 'page' => $page, 'acl' => $acl,  'auth' => $auth)  );
    }

    public function inserirAction()
    {

        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $data = $request->getPost()->toArray();

            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get("Medida\Service\Medida");

                if ($service->insert($data)) {
                    $this->flashMessenger()
                        ->setNamespace('Medida')
                        ->addMessage("Medida cadastrada com sucesso");
                }

                return $this->redirect()->toRoute('medida');
            } else if ($form->isValid()) {
                $this->flashMessenger()
                    ->setNamespace('Medida')
                    ->addMessage("Atualize a página e tente novamente!");
            }

        }


        $messages = $this->flashMessenger()
            ->setNamespace('Medida')
            ->getMessages();

        $view = new ViewModel(array('form' => $form, 'messages' => $messages));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }
}

