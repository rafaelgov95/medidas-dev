<?php

namespace User\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class ManagerController extends \Base\Controller\CrudController
{

    public function __construct()
    {
        $this->entity = "User\Entity\User";
        $this->form = "User\Form\User";
        $this->service = "User\Service\User";
        $this->controller = "manager";
        $this->route = "user/default";
    }

    public function inserirAction()
    {

        $form = new $this->form();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $data = $request->getPost()->toArray();

//            $error = ($data['role'] >= 2 && $data['role'] <= 4) ? 0 : 1;

//            echo $data['role'];die;
            $data['role'] = '3'; //Cadastra como funcionario
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get("User\Service\User");

                if ($service->insert($data)) {
                    $this->flashMessenger()
                        ->setNamespace('User')
                        ->addMessage("Usuário cadastrado com sucesso");
                }

                return $this->redirect()->toRoute('user-register');
            } else if ($form->isValid()) {
                $this->flashMessenger()
                    ->setNamespace('User')
                    ->addMessage("Atualize a página e tente novamente!");
            }

        }

        $messages = $this->flashMessenger()
            ->setNamespace('User')
            ->getMessages();

        $view = new ViewModel(array('form' => $form, 'messages' => $messages));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }
}
