<?php

namespace Medida\Controller;

use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\StringTrim;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\StringUtils;
use Zend\View\Model\JsonModel;

class MedidaController extends AbstractActionController
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
        $this->entity = "Medida\Entity\Medida";
        $this->service = "Medida\Service\Medida";
        $this->form = "Medida\Form\Medida";
        $this->controller = "medida";
        $this->route = "medida/default";

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

        $auth = $this->getServiceLocator()->get("AuthService");
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");

        $order = $this->getEvent()->getRouteMatch()->getParam('order', "nome");
        $orderby = $this->getEvent()->getRouteMatch()->getParam('orderby', "desc");
//        $orderby = $this->getEvent()->getRouteMatch()->getParam('orderby', "asc");
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);

        $type = (int)$this->params()->fromQuery('type'); //tipo
        $search = $this->params()->fromQuery('search'); //busca

        $repo = $this->getEm()->getRepository($this->entity);

//        $type = $this->getEvent()->getRouteMatch()->getParam('type', '1');
//        $search = $this->getEvent()->getRouteMatch()->getParam('search', '');

        $limit = (int)$this->params()->fromQuery('limit'); //busca
        $limit = ($limit > 0 && $limit < 100) ? $limit : 10;
        if (!$search) {
            $search = (new \Zend\Filter\StringTrim())->filter($search);
            $search = (new \Zend\Filter\StripTags())->filter($search);
        }

        if (($type != null && $type > 0 && $type < 10) && $search != null) {
            if ($search || $type) { //troll
//            $search = '';
//                echo $search . $type;
            }
//            $criteria = array();

//            $arry_search = array("1" => "Descricão", "2" => "Secção", "3" => "Atualizado", "4" => "Adicionado");
            $type_query = null;
            Switch ($type) {
                case 1: //oficio
                    $type_query = "oficio";
                    break;
                case 2: //nome
                    $type_query = "nome";
                    break;
                case 3: //acusado
                    $type_query = "acusado";
                    break;
                case 4: //Adicionado
                    try {
//                        if (strpos($search, '-') >= -1) {
//                            $search = explode('-', $search);
//                        } elseif (strpos($search, '/') >= -1) {
//                            $search = explode('/', $search);
//                        }
//                        if (count($search) === 3) {
//
//                            $search = $search[2] . "-" . $search[1] . "-" . $search[3];
//                        }
//                        echo $search;

//                        $search = (new \DateTime($search))->format("Y-m-d");
                    } catch (\Exception $e) {
//                        $search = (new \DateTime('now'))->format("Y-m-d");
                    }
//                    $search = "2015-10-07 00:00:00";
                    $type_query = "data";
                    break;
                case 5: //telefone residencial
                    $type_query = "telr";
                    break;
                case 6: //telefone celular
                    $type_query = "telc";
                    break;
                case 7: //cidade
                    $type_query = "cidade";
                    break;
                case 8: //bairro
                    $type_query = "bairro";
                    break;
                case 9: //endereço
                    $type_query = "rua";
                    break;
//                case 11: //Atualizado
//                    try {
//                        if (strpos($search, '-') >= -1) {
//                            $search = explode('-', $search);
//                        } elseif (strpos($search, '/') >= -1) {
//                            $search = explode('/', $search);
//                        }
//                        if (count($search) === 3) {
//                            $search = $search[2] . "-" . $search[1] . "-" . $search[0];
//                        }
//
//                        $search = (new \DateTime($search))->format("Y-m-d");
//                    } catch (\Exception $e) {
//                        $search = (new \DateTime('now'))->format("Y-m-d");
//                    }
//                    $type_query = "updatedAt";
//                    break;
                default:
                    //action
                    $type = 4;

            }
            $frm_search = array('type' => $type, 'search' => $search);
            try {
                $query = $repo->createQueryBuilder('m')
                    ->where('m.' . $type_query . ' LIKE :search')
                    ->orderBy('m.' . $order, $orderby)
                    ->setParameter('search', "%" . $search . "%")

//                    ->setParameter('order', $order)
//                    ->setParameter('orderby', $orderby )
                    ->getQuery();
//                var_dump($query->getSQL());exit;
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
            $query = $repo->createQueryBuilder('m')
                ->orderBy('m.' . $order, $orderby)
                ->getQuery();
            $list = $query->getResult();


//            $list = $this->getEm()
//                ->getRepository($this->entity)
////                ->orderBy('m.' . $order, $orderby)
//                ->findAll();
            /** @FIXME */
        }
//contador
//        $query = $em->createQuery('SELECT d FROM test d');
//        $query->addWhere("d.exp_date > ?",date("Y-m-d", time()));
//        $query1 = $repo->createQueryBuilder('date')
//            ->where('DATE_DIFF(date.data, CURRENT_DATE()) = 0')
//            ->getQuery();
//        $list1 = $query1->getResult();
//        var_dump($query1);

        $dateNow = (new \DateTime('now'))->format('Y-m-d H:i:s');//2015-07-11 20:42:21

//        $count = $this->getEm();
        $count = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $count->getConfiguration()->addCustomStringFunction('DATEDIFF', 'Doctrine\ORM\Query\AST\Functions\DateDiffFunction');
        $count = $count->getRepository('\Medida\Entity\Medida')
            ->createQueryBuilder('m')
            ->select("count(m.id)")
            ->where("DATEDIFF('$dateNow', m.data) < 30  ")
            ->getQuery()->getResult();

        $ativos = isset($count[0][1])? $count[0][1] : NULL;

        $count = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $count->getConfiguration()->addCustomStringFunction('DATEDIFF', 'Doctrine\ORM\Query\AST\Functions\DateDiffFunction');

        $count = $count->getRepository('\Medida\Entity\Medida')
            ->createQueryBuilder('m')
            ->select("count(m.id)")
            ->getQuery()->getResult();

        $total = isset($count[0][1])? $count[0][1] : NULL;




        $page = $this->params()->fromRoute('page',1);
        $frm_search = array('limit' => $limit) + $frm_search;
//        $page = 2;
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage($limit);

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Medida\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida\Danger')->getCurrentErrorMessages()
        );

//        echo total['ativos'];
        $view = new ViewModel(
            array(
                'frm_legenda' => array(
                    'ativos' => $ativos,
                    'total' => $total
                ),
                'data' => $paginator,
                'page' => $page,
                'messages' => $messages,
                'frm_search' => $frm_search,
                'auth' => $auth,
                'order'=>$order,
                'orderby'=>$orderby,
                'page'=>$page,
                'acl' => $acl
            )
        );


        $view->setTerminal($this->getRequest()->isXmlHttpRequest());
        return $view;
    }


    public function inserirAction()
    {
        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData(
                array_merge_recursive(
                    $this->getRequest()
                        ->getPost()
                        ->toArray(),
                    $this->getRequest()
                        ->getFiles()
                        ->toArray()
                )
            );
            if ($form->isValid()) {
                $data = $form->getData();
                $path_images = '';
                $newFileName = '';
                /* files imagens */

                if (is_array($data['files'])) {//!empty($data['files']['tmp_name'])

                    $tmp_name = $data['files']['tmp_name'];
                    $tmp_name = str_replace('./public', '', $tmp_name);
//                    foreach ($files as $file) {
//                        if(!isset($file['tmp_name']))
//                            break;


//                    $path_default = './public/img/';

                    /** @FIXME */
                    /** @FIXME */
                    /** @FIXME */
                    /** @FIXME */
                    /** @FIXME */

//                    $newFileName = "medida" . rand(129, 12999) . '.pdf';
//                    $path_full = $path_default . $newFileName;


//                    if (!file_exists($path_default))
//                        mkdir($path_default, 0777, true);

                    if (true) {//rename($tmp_name, $path_full)
                        $this->flashMessenger()
                            ->setNamespace('Success')
                            ->addSuccessMessage("PDF" . $tmp_name . " inserida com sucesso");
                    } else {
                        $this->flashMessenger()
                            ->setNamespace('Error')
                            ->addSuccessMessage("Erro ao inserir PDF ");

                    }

//                    }

                } else {
                    echo 'Sem Foto';
                    $this->flashMessenger()
                        ->setNamespace('Error')
                        ->addSuccessMessage("Upload incompleto, tente novamente");
                }
                /* fim uplodas imagens*/

                $service = $this->getServiceLocator()->get($this->service);
                $data['file'] = $tmp_name;//$path_full;

                $resp = $service->insert($data);


                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Medida\Success')
                        ->addSuccessMessage("Medida inserida com sucesso");
                } else {
//                    $form->setData(array_fill_keys(array_keys((array)$data), ''));
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao inserir Medida, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                $messages = array(
                    "Messages" => $this->flashMessenger()->setNamespace('Medida\Current')->getCurrentMessages(),
                    "Success" => $this->flashMessenger()->setNamespace('Medida\Success')->getCurrentSuccessMessages(),
                    "Warning" => $this->flashMessenger()->setNamespace('Medida\Warning')->getCurrentWarningMessages(),
                    "Info" => $this->flashMessenger()->setNamespace('Medida\Info')->getCurrentInfoMessages(),
                    "Danger" => $this->flashMessenger()->setNamespace('Medida\Danger')->getCurrentErrorMessages()
                );
                if ($request->isXmlHttpRequest()) {
                    $data = array('error' => $this->url()->fromRoute($this->route, array('controller' => $this->controller,'action' => 'index')));
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
            "Messages" => $this->flashMessenger()->setNamespace('Medida\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida\Danger')->getCurrentErrorMessages()
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

        $action = "Editar Medida";

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
                        ->setNamespace('Medida\Success')
                        ->addSuccessMessage("As informações do medida foram atualizadas com sucesso!");

                } else {
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao editar medida, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                $messages = array(
                    "Messages" => $this->flashMessenger()->setNamespace('Medida\Current')->getCurrentMessages(),
                    "Success" => $this->flashMessenger()->setNamespace('Medida\Success')->getCurrentSuccessMessages(),
                    "Warning" => $this->flashMessenger()->setNamespace('Medida\Warning')->getCurrentWarningMessages(),
                    "Info" => $this->flashMessenger()->setNamespace('Medida\Info')->getCurrentInfoMessages(),
                    "Danger" => $this->flashMessenger()->setNamespace('Medida\Danger')->getCurrentErrorMessages()
                );
                if ($request->isXmlHttpRequest()) {
                    $data = array('error' => $this->url()->fromRoute($this->route, array('controller' => $this->controller, 'action' => 'index')));
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
            "Messages" => $this->flashMessenger()->setNamespace('Medida\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Medida\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Medida\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Medida\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Medida\Danger')->getCurrentErrorMessages()
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

        $auth = $this->getServiceLocator()->get("AuthService");
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");

        $user = $auth->getIdentity()['user'];

        //         var_dump($this->auth->getIdentity()['user'])->getRole()->getNome();


        $isEdit = $acl->isAllowed($user->getRole()->getNome(), 'Medida::Medida', "Remover");
        if (!$isEdit) {

            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'index'));


        }


        $refid = $this->params()->fromRoute('refid', 0);


        $service = $this->getServiceLocator()->get($this->service);
        $resp = $service->remove($refid);

        if (!is_array($resp)) {
            $this->flashMessenger()
                ->setNamespace('Medida\Success')
                ->addSuccessMessage("Registro da medida foi removido com sucesso!");
        } else {
            $this->flashMessenger()
                ->setNamespace($resp["namespace"])
                ->addErrorMessage("Ops!!! Ocorreu um erro ao remover o registro da medida, entre em contato com suporte." . '<br>' .
                    'Problema: ' . $resp["msg"]);
        }

        return $this->redirect()->toRoute('medida/default', array('controller' => 'medida', 'action' => 'index'));
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

