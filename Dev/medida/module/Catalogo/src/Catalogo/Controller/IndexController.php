<?php

namespace Catalogo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController
{

    private $em;
    private $entity;
    private $service;
    private $controller;
    private $route;

    public function __construct(array $options = array())
    {
        $this->entity = 'Catalogo\Entity\Veiculo';
    }

    public function indexAction()
    {
        $categoria = $this->getEvent()->getRouteMatch()->getParam('categoria', 0);
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);

        $list = $this->getEm()
            ->getRepository($this->entity)
            ->findAll();

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
            ->setDefaultItemCountPerPage(10);

        return new ViewModel(array('data' => $paginator, 'page' => $page));
    }

    public function detalheAction()
    {
        $refidcat = $this->getEvent()->getRouteMatch()->getParam('categoria', 0);
        $refid = $this->getEvent()->getRouteMatch()->getParam('refid', 0);

        $repository = $this->getEm()->getRepository($this->entity);

        $repository2 = $this->getEm()->getRepository('Catalogo\Entity\Categoria');
        $categoria = $repository2->findOneBy(array('descricao' => $refidcat));
        $entity = $repository->findOneBy(array("categoria" => $categoria, "id" => $refid));

        $view = new ViewModel(array("entity" => $entity));//, 'messages' => $messages
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
