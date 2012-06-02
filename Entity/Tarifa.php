<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Tarifa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\TarifaRepository")
 */
class Tarifa
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var integer $periodo
     *
     * @ORM\Column(name="periodo", type="integer")
     */
    private $periodo;

    /**
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var date $validoDesde
     *
     * @ORM\Column(name="validoDesde", type="date")
     */
    private $validoDesde;

    /**
     * @var date $validoHasta
     *
     * @ORM\Column(name="validoHasta", type="date")
     */
    private $validoHasta;


    ////ASOCIACIONES////

    /**
     * @ORM\OneToMany(targetEntity="Contrato", mappedBy="tarifa")
     */
    private $contratos;

    ////FIN ASOCIACIONES////

    public function __construct()
    {
        $this->contratos = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set periodo
     *
     * @param integer $periodo
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    /**
     * Get periodo
     *
     * @return integer 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set precio
     *
     * @param float $precio
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set validoDesde
     *
     * @param date $validoDesde
     */
    public function setValidoDesde($validoDesde)
    {
        $this->validoDesde = $validoDesde;
    }

    /**
     * Get validoDesde
     *
     * @return date 
     */
    public function getValidoDesde()
    {
        return $this->validoDesde;
    }

    /**
     * Set validoHasta
     *
     * @param date $validoHasta
     */
    public function setValidoHasta($validoHasta)
    {
        $this->validoHasta = $validoHasta;
    }

    /**
     * Get validoHasta
     *
     * @return date 
     */
    public function getValidoHasta()
    {
        return $this->validoHasta;
    }


    /**
     * Add contratos
     *
     * @param Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos
     */
    public function addContrato(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Contrato $contratos)
    {
        $this->contratos[] = $contratos;
    }

    /**
     * Get contratos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getContratos()
    {
        return $this->contratos;
    }
}