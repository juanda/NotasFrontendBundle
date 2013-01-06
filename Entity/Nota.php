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
class Nota {

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
     * @ORM\Column(name="texto", type="text", nullable=true)
     */
    private $texto;

    /**
     * @var datetime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

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

    public function __construct() {
        $this->etiquetas = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param text $texto
     */
    public function setTexto($texto) {
        $this->texto = $texto;
    }

    /**
     * Get texto
     *
     * @return text 
     */
    public function getTexto() {
        return $this->texto;
    }

    /**
     * Set fecha
     *
     * @param datetime $fecha
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    /**
     * Get fecha
     *
     * @return datetime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set usuario
     *
     * @param Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario $usuario
     */
    public function setUsuario(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Usuario 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Add etiquetas
     *
     * @param Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas
     */
    public function addEtiqueta(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas) {
        $this->etiquetas[] = $etiquetas;
    }

    /**
     * Get etiquetas
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetas() {
        return $this->etiquetas;
    }

    public function getAbsolutePath($usuario = null) {
        return null === $this->path ? null : $this->getUploadRootDir($usuario) . '/' . $this->path;
    }

    public function getWebPath($usuario = null) {
        return null === $this->path ? null : $this->getUploadDir($usuario) . '/' . $this->path;
    }

    protected function getUploadRootDir($usuario = null) {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir($usuario);
    }

    protected function getUploadDir($usuario = null) {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.        
        if ($usuario)
            return 'uploads/notas/' . $usuario;
        else
            return 'uploads/notas';
    }

    public function upload($usuario = null) {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir($usuario), $this->file->getClientOriginalName());

        // set the path property to the filename where you'ved saved the file
        $this->path = $this->file->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }


    /**
     * Remove etiquetas
     *
     * @param \Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas
     */
    public function removeEtiqueta(\Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Etiqueta $etiquetas)
    {
        $this->etiquetas->removeElement($etiquetas);
    }
}