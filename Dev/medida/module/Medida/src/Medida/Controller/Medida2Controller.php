<?php

namespace Medida2\Controller;

use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\StringTrim;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\StringUtils;
use Zend\View\Model\JsonModel;

class Medida2Controller extends AbstractActionController
{
    private $em;
    private $entity;
    private $service;
    private $controller;
    private $route;

    /* configuração generica */
    private $form_class_default;
    private $style_panel_default;
    private $class_style;

    private $actionInserir;
    private $actionIcon_inserir;

    private $actionEditar;
    private $actionIcon_editar;

    public function __construct()
    {
        $this->entity = "Catalogo\Entity\Medida2";
        $this->service = "Catalogo\Service\Medida2";
        $this->form = "Catalogo\Form\Medida2";
        $this->controller = "medida2";
        $this->route = "catalogo/default";

        /* config */
        $this->style_panel_default = "panel-crud-dark";
        $this->form_class_default = 'form-inline';

        $this->actionInserir = "Adicionar " . $this->controller;
        $this->actionIcon_inserir = 'glyphicon-plus';

        $this->actionEd = "Editar " . $this->controller;
        $this->actionIcon_editar = 'glyphicon-pencil';

        $this->class_style = 'panel-action-form';

    }

    public function indexAction()
    {

        $medida2 = $this->getEvent()->getRouteMatch()->getParam('medida2', 0);
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);
//        $refid =
        $type = (int)$this->params()->fromQuery('type'); //tipo
        $search = $this->params()->fromQuery('search'); //busca

//        $type = $this->getEvent()->getRouteMatch()->getParam('type', '1');
//        $search = $this->getEvent()->getRouteMatch()->getParam('search', '');

        $limit = (int)$this->params()->fromQuery('limit'); //busca
        $limit = ($limit > 0 && $limit < 100) ? $limit : 100;
        if (!$search) {
            $search = (new \Zend\Filter\StringTrim())->filter($search);
            $search = (new \Zend\Filter\StripTags())->filter($search);
        }

        if (($type != null && $type > 0 && $type < 6) && $search != null) {
            if ($search || $type) { //troll
//            $search = '';
//                echo $search . $type;
            }
            $repo = $this->getEm()->getRepository($this->entity);
//            $criteria = array();

//            $arry_search = array("1" => "Descricão", "2" => "Secção", "3" => "Atualizado", "4" => "Adicionado");
            $type_query = null;
            Switch ($type) {
                case 1: //Descricão
                    $type_query = "descricao";
                    break;
                case 2: //Secção
                    $type_query = "seccao";
                    break;
                case 3: //Adicionado
                    try {
                        if (strpos($search, '-') >= -1) {
                            $search = explode('-', $search);
                        } elseif (strpos($search, '/') >= -1) {
                            $search = explode('/', $search);
                        }
                        if (count($search) === 3) {
                            $search = $search[2] . "-" . $search[1] . "-" . $search[0];
                        }

                        $search = (new \DateTime($search))->format("Y-m-d");
                    } catch (\Exception $e) {
                        $search = (new \DateTime('now'))->format("Y-m-d");
                    }
                    $type_query = "createdAt";
                    break;
                case 4: //Atualizado
                    try {
                        if (strpos($search, '-') >= -1) {
                            $search = explode('-', $search);
                        } elseif (strpos($search, '/') >= -1) {
                            $search = explode('/', $search);
                        }
                        if (count($search) === 3) {
                            $search = $search[2] . "-" . $search[1] . "-" . $search[0];
                        }

                        $search = (new \DateTime($search))->format("Y-m-d");
                    } catch (\Exception $e) {
                        $search = (new \DateTime('now'))->format("Y-m-d");
                    }
                    $type_query = "updatedAt";
                    break;
                default:
                    //action
                    $type = 4;

            }
            $frm_search = array('type' => $type, 'search' => $search);
            try {
                $query = $repo->createQueryBuilder('s')
                    ->where('s.' . $type_query . ' LIKE :search')
                    ->setParameter('search', $search . "%")
                    ->getQuery();
                $list = $query->getResult();
            } catch (\Exception $e) {
                $list = array();
                $this->flashMessenger()->addErrorMessage("Ops! Ocorreu um erro na pesquisa, por favor tente novamente!
                     E/ou contate o Administrador!");

            }

//            $list = $repo->findBy($criteria);//"atleta" => $atleta->getId()) + ;

            /** @FIXME */
        } else {
            $frm_search = array('type' => null, 'search' => null);
            $list = $this->getEm()
                ->getRepository($this->entity)
                ->findAll();
            /** @FIXME */
        }

        $page = $this->params()->fromRoute('page', 1);
        $frm_search = array('limit' => $limit) + $frm_search;
//        $page = 2;
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage($limit);

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Medida2\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida2\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida2\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida2\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida2\Danger')->getCurrentErrorMessages()
        );
        $view = new ViewModel(array('data' => $paginator, 'page' => $page, 'messages' => $messages, 'frm_search' => $frm_search));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }


    public function inserirAction()
    {
        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $request->getPost()->toArray();

                $service = $this->getServiceLocator()->get($this->service);
                $resp = $service->insert($data);

                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Medida2\Success')
                        ->addSuccessMessage("Medida2 inserida com sucesso");
                } else {
//                    $form->setData(array_fill_keys(array_keys((array)$data), ''));
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao inserir Medida2, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                $messages = array(
                    "Messages" => $this->flashMessenger()->setNamespace('Medida2\Current')->getCurrentMessages(),
                    "Success" => $this->flashMessenger()->setNamespace('Medida2\Success')->getCurrentSuccessMessages(),
                    "Warning" => $this->flashMessenger()->setNamespace('Medida2\Warning')->getCurrentWarningMessages(),
                    "Info" => $this->flashMessenger()->setNamespace('Medida2\Info')->getCurrentInfoMessages(),
                    "Danger" => $this->flashMessenger()->setNamespace('Medida2\Danger')->getCurrentErrorMessages()
                );
                if ($request->isXmlHttpRequest()) {
                    $data = array('error' => $this->url()->fromRoute($this->route, array('controller' => $this->controller)));
                    $response = $this->getResponse();
                    $response->setStatusCode(200);
                    $response->setContent(json_encode($data));

                    $headers = $response->getHeaders();
                    $headers->addHeaderLine('Content-Type', 'application/json');

                    return $response;

                }

            }
        }

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Medida2\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida2\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida2\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida2\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida2\Danger')->getCurrentErrorMessages()
        );

        $route = $this->url()->fromRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));

        $view = new ViewModel(array(
            'form' => $form,
            'messages' => $messages,
            'action' => $this->actionInserir,
            'route' => $route,
            'style_panel' => $this->style_panel_default,
            'class_style' => $this->class_style,
            'actionIcon' => $this->actionIcon_inserir
        ));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }

    public function editarAction()
    {

        $refid = $this->params()->fromRoute('refid', 0);
        if (!$refid) {
            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));
        }

        $action = "Editar Medida2";

        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();


        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($refid);

        if (!$request->isPost() && $entity && $refid) {
            $form->setData($entity->toArray());
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
                        ->setNamespace('Medida2\Success')
                        ->addSuccessMessage("As informações do medida2 foram atualizadas com sucesso!");
                } else {
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao editar medida2, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                $messages = array(
                    "Messages" => $this->flashMessenger()->setNamespace('Medida2\Current')->getCurrentMessages(),
                    "Success" => $this->flashMessenger()->setNamespace('Medida2\Success')->getCurrentSuccessMessages(),
                    "Warning" => $this->flashMessenger()->setNamespace('Medida2\Warning')->getCurrentWarningMessages(),
                    "Info" => $this->flashMessenger()->setNamespace('Medida2\Info')->getCurrentInfoMessages(),
                    "Danger" => $this->flashMessenger()->setNamespace('Medida2\Danger')->getCurrentErrorMessages()
                );
                if ($request->isXmlHttpRequest()) {
                    $data = array('error' => $this->url()->fromRoute($this->route, array('controller' => $this->controller)));
                    $response = $this->getResponse();
                    $response->setStatusCode(200);
                    $response->setContent(json_encode($data));

                    $headers = $response->getHeaders();
                    $headers->addHeaderLine('Content-Type', 'application/json');

                    return $response;

                }

            }
        }

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Medida2\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida2\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida2\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida2\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida2\Danger')->getCurrentErrorMessages()
        );

        $route = $this->url()->fromRoute($this->route, array('controller' => $this->controller, 'action' => 'editar', 'refid' => $refid));
        $view = new ViewModel(array(
            'form' => $form,
            'messages' => $messages,
            'refid' => $refid,
            'action' => $action,
            'route' => $route,
            'style_panel' => $this->style_panel_default,
            'class_style' => $this->class_style,
            'actionIcon' => $this->actionIcon_editar
        ));
        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
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
                ->setNamespace('Medida2\Success')
                ->addSuccessMessage("Registro da medida2 foi removido com sucesso!");
        } else {
            $this->flashMessenger()
                ->setNamespace($resp["namespace"])
                ->addErrorMessage("Ops!!! Ocorreu um erro ao remover o registro da medida2, entre em contato com suporte." . '<br>' .
                    'Problema: ' . $resp["msg"]);
        }

        return $this->redirect()->toRoute('catalogo/default', array('controller' => 'medida2'));
//        $url = $this->getRequest()->getHeader('Referer')->getUri();
//        $this->redirect()->toUrl($url);
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

