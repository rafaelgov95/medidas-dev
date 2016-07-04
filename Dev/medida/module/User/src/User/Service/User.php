<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Base\Mail\Mail;
use Base\Service\AbstractService;

class User extends AbstractService
{

    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        parent::__construct($em);

        $this->entity = "User\Entity\User";
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data)
    {

//        $role = $this->em->getRepository("Acl\Entity\Role")->findOneByNome($data['role']);

//        $entity = new \User\Entity\User($data);
//        $entity->setRole($role);
//        $this->em->persist($entity);
//        $this->em->flush();
//        var_dump($data['role']);
//        $data['role']++;
        $data['role'] = $this->em->getRepository("Acl\Entity\Role")->findOneBy(array("id" => $data['role']));
//        var_dump($data['role']);die;
        $entity = parent::insert($data);

        $dataEmail = array('login' => $data['login'], 'activationKey' => $entity->getActivationKey());

        if ($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject('Confirmação de cadastro')
                ->setTo($data['email'])
                ->setData($dataEmail)
                ->prepare()
                ->send();
            return $entity;
        }
    }

    public function activate($key)
    {
        $repo = $this->em->getRepository("User\Entity\User");

        $user = $repo->findOneByActivationKey($key);

        if ($user && !$user->getActive()) {
            $user->setActive(true);

            $this->em->persist($user);
            $this->em->flush();

            return $user;
        }
    }

    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);

        if (empty($data['password']))
            unset($data['password']);

        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
