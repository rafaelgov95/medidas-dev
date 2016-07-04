<?php

namespace Catalogo\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Veiculo
 *
 * @ORM\Table(name="veiculo", indexes={@ORM\Index(name="fk_veiculo_categoria1_idx", columns={"categoria_id"}), @ORM\Index(name="fk_veiculo_marca1_idx", columns={"marca_id"}), @ORM\Index(name="fk_veiculo_cliente1_idx", columns={"cliente_id"})})
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Veiculo
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
     * @ORM\Column(name="modelo", type="string", length=50, nullable=false)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="versao", type="string", length=45, nullable=false)
     */
    private $versao;

    /**
     * @var string
     *
     * @ORM\Column(name="ano_modelo", type="string", length=9, nullable=false)
     */
    private $anoModelo;

    /**
     * @var string
     *
     * @ORM\Column(name="cor", type="string", length=45, nullable=false)
     */
    private $cor;

    /**
     * @var string
     *
     * @ORM\Column(name="km", type="string", length=45, nullable=false)
     */
    private $km;

    /**
     * @var integer
     *
     * @ORM\Column(name="portas", type="integer", nullable=false)
     */
    private $portas;

    /**
     * @var string
     *
     * @ORM\Column(name="opcionais", type="string", length=100, nullable=false)
     */
    private $opcionais;

    /**
     * @var integer
     *
     * @ORM\Column(name="direcao", type="integer", nullable=false)
     */
    private $direcao;

    /**
     * @var integer
     *
     * @ORM\Column(name="transmissao", type="integer", nullable=false)
     */
    private $transmissao;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", length=65535, nullable=false)
     */
    private $obs;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="icone", type="string", length=200, nullable=false)
     */
    private $icone;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=200, nullable=false)
     */
    private $path;

    /**
     * @var boolean
     *
     * @ORM\Column(name="stocked", type="boolean", nullable=false)
     */
    private $stocked;

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
     * @var \Catalogo\Entity\Marca
     *
     * @ORM\ManyToOne(targetEntity="Catalogo\Entity\Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca_id", referencedColumnName="id")
     * })
     */
    private $marca;

    /**
     * @var \Catalogo\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="Catalogo\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Cliente\Entity\Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->setCreatedAt()
            ->setUpdatedAt();

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    /**
     * @param array $data
     */
    public function setArray(array $data = array())
    {
        (new Hydrator\ClassMethods())->hydrate($data, $this);
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @throws \Exception
     */
    public function exchangeArray()
    {
        throw new \Exception("Não usado");
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param $modelo
     * @return $this
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * @param $versao
     * @return $this
     */
    public function setVersao($versao)
    {
        $this->versao = $versao;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnoModelo()
    {
        return $this->anoModelo;
    }

    /**
     * @param $anoModelo
     * @return $this
     */
    public function setAnoModelo($anoModelo)
    {
        $this->anoModelo = $anoModelo;
        return $this;
    }

    /**
     * @return string
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * @param $cor
     * @return $this
     */
    public function setCor($cor)
    {
        $this->cor = $cor;
        return $this;
    }

    /**
     * @return string
     */
    public function getKm()
    {
        return $this->km;
    }

    /**
     * @param $km
     * @return $this
     */
    public function setKm($km)
    {
        $this->km = $km;
        return $this;
    }

    /**
     * @return int
     */
    public function getPortas()
    {
        return $this->portas;
    }

    /**
     * @param $portas
     * @return $this
     */
    public function setPortas($portas)
    {
        $this->portas = $portas;
        return $this;
    }

    /**
     * @return string
     */
    public function getOpcionais()
    {
        return $this->opcionais;
    }

    /**
     * @param $opcionais
     * @return $this
     */
    public function setOpcionais($opcionais)
    {
        $this->opcionais = $opcionais;
        return $this;
    }

    /**
     * @return int
     */
    public function getDirecao()
    {
        return $this->direcao;
    }

    /**
     * @param $direcao
     * @return $this
     */
    public function setDirecao($direcao)
    {
        $this->direcao = $direcao;
        return $this;
    }

    /**
     * @return int
     */
    public function getTransmissao()
    {
        return $this->transmissao;
    }

    /**
     * @param $transmissao
     * @return $this
     */
    public function setTransmissao($transmissao)
    {
        $this->transmissao = $transmissao;
        return $this;
    }

    /**
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param $obs
     * @return $this
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * @param $icone
     * @return $this
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isStocked()
    {
        return $this->stocked;
    }

    /**
     * @param $stocked
     * @return $this
     */
    public function setStocked($stocked)
    {
        $this->stocked = $stocked;
        return $this;
    }

    /**
     * @return Marca
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param $marca
     * @return $this
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
        return $this;
    }

    /**
     * @return Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param $categoria
     * @return $this
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
        return $this;
    }


    /**
     * @return \Cliente\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }


    /**
     * @param $cliente
     * @return $this
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
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


}

