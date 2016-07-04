<?php

namespace Cliente\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\StringTrim;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\StringUtils;

class IndexController extends AbstractActionController
{
    private $em;

    public function __construct()
    {
        $this->entity = "Cliente\Entity\Cliente";
        $this->service = "Cliente\Service\Cliente";
        $this->form = "Cliente\Form\Cliente";
        $this->controller = "Index";
        $this->route = "cliente/default";
    }

    public function indexAction()
    {
        return new ViewModel();
    }


    public function inserirAction()
    {
        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
//            $data['user'] = '2';
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();


                $service = $this->getServiceLocator()->get($this->service);
                $resp = $service->insert($data);


                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Cliente\Index')
                        ->addSuccessMessage("Cliente inserido com sucesso");
                } else {
//                    $form->setData(array_fill_keys(array_keys((array)$data), ''));
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao inserir cliente, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
//                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));
//                $url = $this->getRequest()->getHeader('Referer')->getUri();
//                $this->redirect()->toUrl($url);

            }
        }

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Cliente\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Cliente\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Cliente\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Cliente\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Cliente\Danger')->getCurrentErrorMessages()
        );

//        var_dump($messages);die;
//        if (null != $call) {
//            return $form;
//        } else {
//            return ();
//        }
        $view = new ViewModel(array('form' => $form, 'messages' => $messages));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }
}

