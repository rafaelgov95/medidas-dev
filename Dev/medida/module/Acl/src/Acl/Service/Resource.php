<?php

namespace Acl\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;

class Resource extends AbstractService
{
    public function __construct(EntityManager $em, ServiceManager $sm) {
        parent::__construct($em);
        $this->entity = "Acl\Entity\Resource";
    }
    
    
}
