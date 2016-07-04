<?php

namespace Medida\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Base\Mail\Mail;
use Base\Service\AbstractService;

class Medida extends AbstractService
{
    protected $sm;

    public function __construct(EntityManager $em, ServiceManager $sm)
    {
        parent::__construct($em);
        $this->sm = $sm;
        $this->entity = "Medida\Entity\Medida";

    }

    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        return $this->persist($entity);

    }


    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);

        (new Hydrator\ClassMethods())->hydrate($data, $entity);

//        $this->em->persist($entity);
//        $this->em->flush();
//        return $entity;
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
                $error = 'Medida\Danger';
                $msg = "Já está cadastrado.";
            } else {

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
                $error = false;
                $msg = false;

                if ($e->getPrevious() && 0 === strpos($e->getPrevious()->getCode(), '23')) {
                    $error = 'Medida\Danger';
                    $msg = "Não foi possivel remover o registro.";
                } else {
                    $error = 'Medida\Danger';
                    $msg = "Não foi possivel remover o registro.";
                }
                return array('namespace' => $error, 'msg' => $msg);
            }
        } else {
            $error = 'Medida\Danger';
            $msg = "Registro não encontrado.";
            return array('namespace' => $error, 'msg' => $msg);
        }
        return 1;
    }
}
