<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function registerAction()
    {

//        $form = $this->getServiceLocator()->get("User\Form\User");
        $form = new \User\Form\User();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $data = $request->getPost()->toArray();

            $error = 0; //($data['role'] >= 2 && $data['role'] <= 4)?0:1;
            $data['role'] = '2';//Cadastra como User registrado por padrão
            if ($form->isValid() && $error == 0) {

                $service = $this->getServiceLocator()->get("User\Service\User");

                if ($service->insert($data)) {
                    $this->flashMessenger()
                        ->setNamespace('User')
                        ->addMessage("Usuário cadastrado com sucesso");
                }

                return $this->redirect()->toRoute('user-register');
            } else if ($form->isValid() && $error != 0) {
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

    public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');
        if($activationKey) {
            $userService = $this->getServiceLocator()->get('User\Service\User');
            $result = $userService->activate($activationKey);

            if ($result)
                return new ViewModel(array('user' => $result));
            else
                return new ViewModel();
        }
    }

    public function getEm()
    {
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

}
