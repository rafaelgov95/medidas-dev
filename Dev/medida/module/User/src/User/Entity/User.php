<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;
//use Zend\Stdlib\Rand,
use Zend\Stdlib\Hydrator;


/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="Login_UNIQUE", columns={"login"}), @ORM\UniqueConstraint(name="Email_UNIQUE", columns={"email"})}, indexes={@ORM\Index(name="fk_user_acl_roles1_idx", columns={"acl_roles_id"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="User\Entity\UserRepository")
 */
class User
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
     * @ORM\Column(name="login", type="string", length=30, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

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
     * @var \Acl\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;


    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
        return $this;
    }

    public function getActivationKey()
    {
        return $this->activationKey;
    }

    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setRole(\Acl\Entity\Role $role)
    {
        $this->role = $role;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setSalt($salt = null)
    {
        if ($this->salt == null && $salt == null) {
            $this->salt = base64_encode(Rand::getBytes(8, true));
        } else if ($salt != null) {
            $this->salt = $salt;
        }
        return $this;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * @return $this
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime('now');
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __construct(array $options = array())
    {
//        $hydrator = new Hydrator\ClassMethods;
//        $hydrator->hydrate($options, $this);
        (new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->setCreatedAt()
            ->setUpdatedAt()
            ->setActive(false)
            ->setSalt()
            ->setActivationKey(md5($this->email . $this->salt . $this->getCreatedAt()->getTimestamp()));

        return $this;
    }

    public function encryptPassword($password)
    {
        $this->setSalt();
        return base64_encode(Pbkdf2::calc('md5', $password, $this->salt, 10000, strlen($password * 2)));
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    public function setArray(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
    }
}
