<?php

namespace TissiBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contactos")
 */
class Contacto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string")
     */
    protected $apellido;


    /**
     * @ORM\Column(type="string")
     */
    protected $telefono;

    /**
     * @ORM\Column(type="string")
     */
    protected $correo;

    /**
     * @ORM\Column(type="text")
     */
    protected $tipo_de_cliente; 

    /**
     * @ORM\Column(type="text")
     */
    protected $comentarios; 

    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $adjuntar;   

    

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Contacto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido.
     *
     * @param string $apellido
     *
     * @return Contacto
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido.
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefono.
     *
     * @param string $telefono
     *
     * @return Contacto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set correo.
     *
     * @param string $correo
     *
     * @return Contacto
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo.
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set tipoDeCliente.
     *
     * @param string $tipoDeCliente
     *
     * @return Contacto
     */
    public function setTipoDeCliente($tipoDeCliente)
    {
        $this->tipo_de_cliente = $tipoDeCliente;

        return $this;
    }

    /**
     * Get tipoDeCliente.
     *
     * @return string
     */
    public function getTipoDeCliente()
    {
        return $this->tipo_de_cliente;
    }

    /**
     * Set comentarios.
     *
     * @param string $comentarios
     *
     * @return Contacto
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios.
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set adjuntar.
     *
     * @param string|null $adjuntar
     *
     * @return Contacto
     */
    public function setAdjuntar($adjuntar = null)
    {
        $this->adjuntar = $adjuntar;

        return $this;
    }

    /**
     * Get adjuntar.
     *
     * @return string|null
     */
    public function getAdjuntar()
    {
        return $this->adjuntar;
    }
}
