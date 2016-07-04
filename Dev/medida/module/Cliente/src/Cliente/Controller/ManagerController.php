<?php

namespace Cliente\Controller;

use Zend\Filter\Null;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\Partial;
use Zend\View\Model\ViewModel;
use Zend\Filter\StringTrim;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\StringUtils;

class ManagerController extends AbstractActionController
{
    private $em;
    private $entity;
    private $service;
    private $controller;
    private $route;

    public function __construct()
    {
        $this->entity = "Cliente\Entity\Cliente";
        $this->service = "Cliente\Service\Cliente";
        $this->form = "Cliente\Form\Cliente";
        $this->controller = "Manager";
        $this->route = "cliente/default";
    }

    public function indexAction()
    {
        $categoria = $this->getEvent()->getRouteMatch()->getParam('categoria', 0);
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);
//        echo '<div class="well">'
//            . 'Categoria: ' . $categoria . '<br>'
//            . 'ID: ' . $refid
//            . '</div>';

        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Cliente\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Cliente\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Cliente\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Cliente\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Cliente\Danger')->getCurrentErrorMessages()
        );

//        $forwardPlugin = $this->forward();
//        $content_temp = $forwardPlugin->dispatch('cliente\controller\index',
//            array('action' => 'Inserir'));
        $content_temp = $this->forward()->dispatch('cliente\controller\index',
            array('action' => 'inserir'));
        $action = array('cliente\controller\index',
            array('action' => 'Inserir'));
//        $content_temp = new Partial('partials/content_temp');
//        $content_temp->setTemplate('partials/content_temp'); // path to phtml file under view folder
//        return $view;

//        $content_temp = (new \Cliente\Controller\IndexController())->inserirAction();
        $view = new ViewModel(array('data' => $paginator, 'page' => $page, 'messages' => $messages, 'content_temp' => $content_temp));
//        $content_temp = $view->addChild('partials/content_temp');
        $view->addChild($content_temp, 'content_temp');
        return $view;
    }

    public function detalheAction()
    {
//        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);

//          $repository = $this->getEm()->getRepository($this->entity);

//        $repository2 = $this->getEm()->getRepository('Catalogo\Entity\Categoria');
//        $categoria = $repository2->findOneBy(array('descricao' => $refidcat));
//        $entity = $repository->findOneBy(array("categoria" => $categoria, "id" => $refid));
//        $entity = $repository->findOneBy(array("id" => $refid));

        $form = $this->getServiceLocator()->get("Cliente\Form\Cliente");

        $request = $this->getRequest();


        $auth = $this->getServiceLocator()->get('AuthService');
        $user = $auth->getIdentity()['user'];

        $repository = $this->getEm()->getRepository($this->entity);
//        $repository = $this->getEm()->getRepository($this->entity);

        $refid = $this->params()->fromRoute('refid', 0);

        if ($user->getRole()->getNome() == "Admin") {
            $refid = $refid == 0 ? $user->getId() : $refid;
            $entity = $repository->find($refid);
//            echo $entity;
            /** @FIXME
             * No Perfil so se for admin podera ver outros perfis,
             * a não ser o proprio do usuario.
             */
        } else if (($user->getRole()->getNome() != "Admin") & ($refid == 0 || $refid == $user->getId())) {
            $entity = $repository->findOneBy(array('user' => $user->getId()));
//            if ($entity & $entity->getUser()->getId() != $refid) {
//                $entity = NULL;
//            } else {
////            $refid = $entity ? $user->getId() : NULL;
//                $entity = NULL;
//            }
        } else {
            $entity = NULL;
        }

        if (!$request->isPost() && $entity && $refid) {
            $form->setData($entity->toArray());
//            $form->bind($entity);
//            $form->get("profissional")->setValue($entity->getProfissional() ? $entity->getProfissional()->getCref() : "");
        }

        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();
//                print_r($data);die;
                $service = $this->getServiceLocator()->get($this->service);
                $resp = $service->update($data);

                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Cliente\Success')
                        ->addSuccessMessage("As informações do cliente foram atualizadas com sucesso!");
                } else {
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao editar os dados do cliente, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
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
        $route = $this->url()->fromRoute($this->route, array('controller' => $this->controller, 'action' => 'editar', 'refid' => $refid));

        $view = new ViewModel(array("entity" => $entity, 'form' => $form, 'messages' => $messages, 'refid' => $refid, 'route' => $route));

//        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
//        return $view;
//        $view = new ViewModel(array("entity" => $entity));//, 'messages' => $messages
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }

    public function inserirAction()
    {
        return new ViewModel();
    }

    public function removerAction()
    {

//        $auth = $this->getServiceLocator()->get("AuthService");
//        $atleta = $this->CheckAtleta($auth);
//        if (!$atleta) {
//            $this->redirect()->toRoute("atleta/default", array("controller" => "perfil", "action" => "new"));
//        }

        $refid = $this->params()->fromRoute('refid', 0);


        $service = $this->getServiceLocator()->get($this->service);
        $resp = $service->remove($refid);

        if (!is_array($resp)) {
            $this->flashMessenger()
                ->setNamespace('Cliente\Success')
                ->addSuccessMessage("Registro do cliente foi removido com sucesso!");
        } else {
            $this->flashMessenger()
                ->setNamespace($resp["namespace"])
                ->addErrorMessage("Ops!!! Ocorreu um erro ao remover o registro do cliente, entre em contato com suporte." . '<br>' .
                    'Problema: ' . $resp["msg"]);
        }

//        $messages = array(
//            "Messages" => $this->flashMessenger()->setNamespace('Cliente\Current')->getCurrentMessages(),
//            "Success" => $this->flashMessenger()->setNamespace('Cliente\Success')->getCurrentSuccessMessages(),
//            "Warning" => $this->flashMessenger()->setNamespace('Cliente\Warning')->getCurrentWarningMessages(),
//            "Info" => $this->flashMessenger()->setNamespace('Cliente\Info')->getCurrentInfoMessages(),
//            "Danger" => $this->flashMessenger()->setNamespace('Cliente\Danger')->getCurrentErrorMessages()
//        );

        return $this->redirect()->toRoute('cliente/default', array('controller' => 'manager'));
//        $url = $this->getRequest()->getHeader('Referer')->getUri();
//        $this->redirect()->toUrl($url);
    }

    public function editarAction()
    {
        $form = $this->getServiceLocator()->get("Cliente\Form\Cliente");

        $request = $this->getRequest();
        $refid = $this->params()->fromRoute('refid', 0);
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($refid);

        if (!$request->isPost() && $entity && $refid) {
            $form->setData($entity->toArray());
//            $form->bind($entity);
//            $form->get("profissional")->setValue($entity->getProfissional() ? $entity->getProfissional()->getCref() : "");
        }

        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $request->getPost()->toArray();
//                print_r($data);die;
                $service = $this->getServiceLocator()->get($this->service);
                $resp = $service->update($data);

                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Cliente\Success')
                        ->addSuccessMessage("As informações do cliente foram atualizadas com sucesso!");
                } else {
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao editar os dados do cliente, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
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
        $view = new ViewModel(array('form' => $form, 'messages' => $messages, 'refid' => $refid));

        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        return $this->em;
    }
}

