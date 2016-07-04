<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclRoles
 *
 * @ORM\Table(name="acl_roles", uniqueConstraints={@ORM\UniqueConstraint(name="nome", columns={"nome"})}, indexes={@ORM\Index(name="fk_acl_roles_acl_roles1_idx", columns={"parent_id"})})
 * @ORM\Entity
 */
class AclRoles
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
     * @ORM\Column(name="theme_layout", type="string", length=15, nullable=false)
     */
    private $themeLayout;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_admin", type="boolean", nullable=false)
     */
    private $isAdmin;

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
     * @var \Application\Entity\AclRoles
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\AclRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;


}

