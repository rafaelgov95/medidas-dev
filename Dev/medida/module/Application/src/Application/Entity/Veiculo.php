<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Veiculo
 *
 * @ORM\Table(name="veiculo", indexes={@ORM\Index(name="fk_veiculo_categoria1_idx", columns={"categoria_id"}), @ORM\Index(name="fk_veiculo_marca1_idx", columns={"marca_id"}), @ORM\Index(name="fk_veiculo_cliente1_idx", columns={"cliente_id"})})
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
     * @ORM\Column(name="opcionais", type="string", length=100, nullable=false)
     */
    private $opcionais;

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
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=45, nullable=false)
     */
    private $hash;

    /**
     * @var \Application\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Application\Entity\Cliente
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @var \Application\Entity\Marca
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca_id", referencedColumnName="id")
     * })
     */
    private $marca;


}

