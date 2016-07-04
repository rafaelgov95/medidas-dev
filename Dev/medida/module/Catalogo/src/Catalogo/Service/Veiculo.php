<?php

namespace Catalogo\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Base\Mail\Mail;
use Base\Service\AbstractService;

class Veiculo extends AbstractService
{
    protected $sm;

    public function __construct(EntityManager $em, ServiceManager $sm)
    {
        parent::__construct($em);
        $this->sm = $sm;
        $this->entity = "Catalogo\Entity\Veiculo";

    }

    public function insert(array $data)
    {
//        $entity = new $this->entity($data);
//        $marca = $this->em->getRepository("Catalogo\Entity\Marca")
//            ->findOneBy(array("id" => $data["marca"]));
//
//        $categoria = $this->em->getRepository("Catalogo\Entity\Categoria")
//            ->findOneBy(array("id" => $data["categoria"]));
//
//        $cliente = $this->em->getRepository("\Cliente\Entity\Cliente")
//            ->findOneBy(array("id" => $data["cliente"]));
//
//        if (!$marca) {
//            return array("namespace" => "Veiculo\Error", "msg" => "Marca não encontrado");
//        } else if (!$categoria) {
//            return array("namespace" => "Veiculo\Error", "msg" => "Categoria não encontrado");
//        } else if (!$cliente) {
//            return array("namespace" => "Veiculo\Error", "msg" => "Cliente não encontrado");
//        }

        $entity = new $this->entity($data);

//        $entity->setMarca($marca);
//        $entity->setCliente($cliente);
//        $entity->setCategoria($categoria);

        return $this->persist($entity);
    }


    public function update(array $data)
    {

        $data["marca"] = $this->em->getRepository("Catalogo\Entity\Marca")
            ->findOneBy(array("id" => $data["marca"]));

        if (!$data["marca"]) {
            return array("namespace" => "Veiculo\Error", "msg" => "Marca não encontrado");
        }

        $data["categoria"] = $this->em->getRepository("Catalogo\Entity\Categoria")
            ->findOneBy(array("id" => $data["categoria"]));

        if (!$data["categoria"]) {
            return array("namespace" => "Veiculo\Error", "msg" => "Categoria não encontrado");
        }

        $data["cliente"] = $this->em->getRepository("\Cliente\Entity\Cliente")
            ->findOneBy(array("id" => $data["cliente"]));

        if (!$data["cliente"]) {
            return array("namespace" => "Veiculo\Error", "msg" => "Cliente não encontrado");
        }

        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        return $this->persist($entity);
    }

    private function persist($entity)
    {
        try {
            $this->em->persist($entity);
            $this->em->flush();
        } catch (\Doctrine\DBAL\DBALException $e) {
            $error = false;
            $msg = false;

            if ($e->getPrevious() && 0 === strpos($e->getPrevious()->getCode(), '23')) {
                $error = 'Veiculo\Danger';
                $msg = "Já está cadastrado.";
            } else {
                $error = 'Veiculo\Danger';
                $msg = "Erro desconhecido.";
            }
            return array('namespace' => $error, 'msg' => $msg);
        }
        return 1;
    }

    public function remove($id)
    {
        if ($entity = $this->em->getReference($this->entity, $id)) {
            try {
                $this->em->remove($entity);
                $this->em->flush();
            } catch (\Doctrine\DBAL\DBALException $e) {

                if ($e->getPrevious() && 0 === strpos($e->getPrevious()->getCode(), '23')) {
                    $error = 'Veiculo\Danger';
                    $msg = "Não foi possivel remover o registro.";
                } else {
                    $error = 'Veiculo\Danger';
                    $msg = "Não foi possivel remover o registro.";
                }
                return array('namespace' => $error, 'msg' => $msg);
            }
        } else {
            $error = 'Veiculo\Danger';
            $msg = "Registro não encontrado.";
            return array('namespace' => $error, 'msg' => $msg);
        }
        return 1;
    }
}
