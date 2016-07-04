<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclResources
 *
 * @ORM\Table(name="acl_resources", uniqueConstraints={@ORM\UniqueConstraint(name="nome", columns={"nome"})})
 * @ORM\Entity
 */
class AclResources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=20, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=20, nullable=false)
     */
    private $route;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;


}

