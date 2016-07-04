<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclPrivileges
 *
 * @ORM\Table(name="acl_privileges", indexes={@ORM\Index(name="FK_3E91380789329D25", columns={"resource_id"}), @ORM\Index(name="FK_3E913807D60322AC", columns={"role_id"})})
 * @ORM\Entity
 */
class AclPrivileges
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
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

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

    /**
     * @var \Application\Entity\AclResources
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclResources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;

    /**
     * @var \Application\Entity\AclRoles
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;


}

