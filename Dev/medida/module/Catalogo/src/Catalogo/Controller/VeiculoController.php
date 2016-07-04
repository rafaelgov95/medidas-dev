<?php

namespace Catalogo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Filter\StringTrim;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\StringUtils;
use Zend\Validator\File\Size;

class VeiculoController extends AbstractActionController
{
    private $em;
    private $entity;
    private $service;
    private $controller;
    private $route;

    public function __construct()
    {
        $this->entity = "Catalogo\Entity\Veiculo";
        $this->service = "Catalogo\Service\Veiculo";
        $this->form = "Catalogo\Form\Veiculo";
        $this->controller = "veiculo";
        $this->route = "catalogo/default";
    }

    public function indexAction()
    {
        $veiculo = $this->getEvent()->getRouteMatch()->getParam('veiculo', 0);
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);

        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Veiculo\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Veiculo\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Veiculo\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Veiculo\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Veiculo\Danger')->getCurrentErrorMessages()
        );

        return new ViewModel(array('data' => $paginator, 'page' => $page, 'messages' => $messages));
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
//            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();
                $marca = $this->getEm()->getRepository("Catalogo\Entity\Marca")
                    ->findOneBy(array("id" => $data["marca"]));

                $categoria = $this->getEm()->getRepository("Catalogo\Entity\Categoria")
                    ->findOneBy(array("id" => $data["categoria"]));

                $cliente = $this->getEm()->getRepository("\Cliente\Entity\Cliente")
                    ->findOneBy(array("id" => $data["cliente"]));

                if (!$marca) {
                    $this->flashMessenger()
                        ->setNamespace('Veiculo\Error')
                        ->addSuccessMessage("Marca não encontrado");
                } else if (!$categoria) {
                    $this->flashMessenger()
                        ->setNamespace('Veiculo\Error')
                        ->addSuccessMessage("Categoria não encontrado");
                } else if (!$cliente) {
                    $this->flashMessenger()
                        ->setNamespace('Veiculo\Error')
                        ->addSuccessMessage("Cliente não encontrado");
                }

                $path_images = '';
                $newFileName = '';
                /* files imagens */

//                echo '<div class="well"><pre>'
//                    . var_export($data, true)
//                    . '</pre></div>';
                if (is_array($data['files'])) {//!empty($data['files']['tmp_name'])
//                    echo $data['files']['tmp_name'];
                    $files = $data['files'];
                    foreach($files as $file) {
                        $tmp_name = $file['tmp_name'];

                        $path_default = './public';
                        $path_images = '/img/cars/' . $marca->getDescricao() . '/' . $data['modelo'] . '/v' . $data['versao'] . '/' . $cliente->getNome() . '-' . ((new \DateTime('now'))->format('d-m-Y-H-i-s') . '/');
                        $newFileName = rand(129, 12999) . '.jpg';

                        $path_full = $path_default . $path_images . $newFileName;
//                        echo $path_full;
                        if (!file_exists($path_default . $path_images))
                            mkdir($path_default . $path_images, 0777, true);


//                    var_dump($path . );
//                    exit;
//                    echo $tmp_name;

                        if (rename($tmp_name, $path_full)) {
                            $this->flashMessenger()
                                ->setNamespace('Success')
                                ->addSuccessMessage("Imagem " . $file['tmp_name'] . " inserida com sucesso");
//                        return $filename;
                        } else {
                            $this->flashMessenger()
                                ->setNamespace('Error')
                                ->addSuccessMessage("Erro ao inserir imagem ");
//                        return false;
                        }
                    }
//                    $tmp_name = $data['files']['tmp_name'];
//
//                    $path_default = './public';
//                    $path_images = '/img/cars/' . $marca->getDescricao() . '/' . $data['modelo'] . '/v' . $data['versao'] . '/' . $cliente->getNome() . '-' . ((new \DateTime('now'))->format('d-m-Y') . '/');
//                    $newFileName = rand(129, 12999) . '.jpg';
//
//                    $path_full = $path_default . $path_images . $newFileName;
//                    echo $path_full;
//                    if (!file_exists($path_default . $path_images))
//                        mkdir($path_default . $path_images, 0777, false);
//
//
////                    var_dump($path . );
////                    exit;
////                    echo $tmp_name;
//
//                    if (rename($tmp_name, $path_full)) {
//                        $this->flashMessenger()
//                            ->setNamespace('Success')
//                            ->addSuccessMessage("Imagem " . $data['files']['tmp_name'] . " inserida com sucesso");
////                        return $filename;
//                    } else {
//                        $this->flashMessenger()
//                            ->setNamespace('Error')
//                            ->addSuccessMessage("Erro ao inserir imagem ");
////                        return false;
//                    }

                } else {
                    echo 'Sem Foto';
                    $this->flashMessenger()
                        ->setNamespace('Error')
                        ->addSuccessMessage("Upload incompleto, tente novamente");
                }
                /* fim uplodas imagens*/

                $service = $this->getServiceLocator()->get($this->service);
                $data['marca'] = $marca;
                $data['categoria'] = $categoria;
                $data['cliente'] = $cliente;
                $data['path'] = $path_images;
                $data['icone'] = $path_images . $newFileName;
                $resp = $service->insert($data);


                if (!is_array($resp)) {
                    $this->flashMessenger()
                        ->setNamespace('Veiculo\Success')
                        ->addSuccessMessage("Veiculo inserida com sucesso");
                } else {
//                    $form->setData(array_fill_keys(array_keys((array)$data), ''));
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao inserir veiculo, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
//                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));
//                $url = $this->getRequest()->getHeader('Referer')->getUri();
//                $this->redirect()->toUrl($url);

            }
        }

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Veiculo\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Veiculo\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Veiculo\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Veiculo\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Veiculo\Danger')->getCurrentErrorMessages()
        );

        $view = new ViewModel(array('form' => $form, 'messages' => $messages));
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
                ->setNamespace('Veiculo\Success')
                ->addSuccessMessage("Registro da veiculo foi removido com sucesso!");
        } else {
            $this->flashMessenger()
                ->setNamespace($resp["namespace"])
                ->addErrorMessage("Ops!!! Ocorreu um erro ao remover o registro da veiculo, entre em contato com suporte." . '<br>' .
                    'Problema: ' . $resp["msg"]);
        }

        return $this->redirect()->toRoute('catalogo/default', array('controller' => 'veiculo'));
//        $url = $this->getRequest()->getHeader('Referer')->getUri();
//        $this->redirect()->toUrl($url);
    }

    public function editarAction()
    {
        $form = $this->getServiceLocator()->get($this->form);

        $request = $this->getRequest();
        $refid = $this->params()->fromRoute('refid', 0);
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
                        ->setNamespace('Veiculo\Success')
                        ->addSuccessMessage("As informações do veiculo foram atualizadas com sucesso!");
                } else {
                    $this->flashMessenger()
                        ->setNamespace($resp["namespace"])
                        ->addErrorMessage("Ops!!! Ocorreu um erro ao editar veiculo, entre em contato com suporte." . '<br>' .
                            'Problema: ' . $resp["msg"]);
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
//                $url = $this->getRequest()->getHeader('Referer')->getUri();
//                $this->redirect()->toUrl($url);

            }
        }

        $messages = array(
            "Messages" => $this->flashMessenger()->setNamespace('Veiculo\Current')->getCurrentMessages(),
            "Success" => $this->flashMessenger()->setNamespace('Veiculo\Success')->getCurrentSuccessMessages(),
            "Warning" => $this->flashMessenger()->setNamespace('Veiculo\Warning')->getCurrentWarningMessages(),
            "Info" => $this->flashMessenger()->setNamespace('Veiculo\Info')->getCurrentInfoMessages(),
            "Danger" => $this->flashMessenger()->setNamespace('Veiculo\Danger')->getCurrentErrorMessages()
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

