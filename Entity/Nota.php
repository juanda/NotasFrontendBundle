<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\NotaRepository")
 */
class Nota
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
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     * 
     * @Assert\NotBlank()
     * @Assert\MaxLength(255)
     */
    private $titulo;

    /**
     * @var text $texto
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * @var datetime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    ////ASOCIACIONES////

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     */
    private $usuario;

    /**
     * @ORM\ManyToMany(targetEntity="Etiqueta", inversedBy="notas")
     */
    private $etiquetas;

    ////FIN ASOCIACIONES////

    public function __construct()
    {
        $this->etiquetas = new ArrayCollection();
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
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param text $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    /**
     * Get texto
     *
     * @return text 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * Set usuario
     *
     * @param Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario $usuario
     */
    public function setUsuario(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add etiquetas
     *
     * @param Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas
     */
    public function addEtiqueta(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas[] = $etiquetas;
    }

    /**
     * Get etiquetas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas()
    {
        return $this->etiquetas;
    }
}