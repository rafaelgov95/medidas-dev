<?php

namespace Medida\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Medida
 *
 * @ORM\Table(name="medida")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Medida
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
     * @ORM\Column(name="oficio", type="string", length=45, nullable=false)
     */
    private $oficio;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="acusado", type="string", length=255, nullable=false)
     */
    private $acusado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="telr", type="string", length=11, nullable=false)
     */
    private $telr;

    /**
     * @var string
     *
     * @ORM\Column(name="telc", type="string", length=11, nullable=false)
     */
    private $telc;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=60, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=45, nullable=false)
     */
    private $cidade;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=45, nullable=false)
     */
    private $bairro;

    /**
     * @var string
     *
     * @ORM\Column(name="rua", type="string", length=45, nullable=false)
     */
    private $rua;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", nullable=false)
     */
    private $file;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getOficio()
    {
        return $this->oficio;
    }

    /**
     * @param string $oficio
     */
    public function setOficio($oficio)
    {
        $this->oficio = $oficio;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getAcusado()
    {
        return $this->acusado;
    }

    /**
     * @param string $acusado
     */
    public function setAcusado($acusado)
    {
        $this->acusado = $acusado;
    }

    /**
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param \DateTime $data
     */
    public function setData($data)
    {
        $this->data = new \DateTime($data);
    }

    /**
     * @return string
     */
    public function getTelr()
    {
        return $this->telr;
    }

    /**
     * @param string $telr
     */
    public function setTelr($telr)
    {
        $this->telr = $telr;
    }

    /**
     * @return string
     */
    public function getTelc()
    {
        return $this->telc;
    }

    /**
     * @param string $telc
     */
    public function setTelc($telc)
    {
        $this->telc = $telc;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * @param string $cidade
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    /**
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param string $bairro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    /**
     * @return string
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * @param string $rua
     */
    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
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
            ->setUpdatedAt();
        return $this;
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

