<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CanalPorts
 *
 * @ORM\Table(name="canal_ports", indexes={@ORM\Index(name="fk_canal_ports_canal_1", columns={"canal_id"}), @ORM\Index(name="fk_canal_ports_ports_1", columns={"port_id"})})
 * @ORM\Entity
 */
class CanalPorts
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
     * @var boolean
     *
     * @ORM\Column(name="port_type", type="boolean", nullable=false)
     */
    private $portType;

    /**
     * @var \Canal
     *
     * @ORM\ManyToOne(targetEntity="Canal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="canal_id", referencedColumnName="ext_id")
     * })
     */
    private $canal;

    /**
     * @var \Ports
     *
     * @ORM\ManyToOne(targetEntity="Ports")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="port_id", referencedColumnName="id")
     * })
     */
    private $port;



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
     * Set portType
     *
     * @param boolean $portType
     * @return CanalPorts
     */
    public function setPortType($portType)
    {
        $this->portType = $portType;

        return $this;
    }

    /**
     * Get portType
     *
     * @return boolean 
     */
    public function getPortType()
    {
        return $this->portType;
    }

    /**
     * Set canal
     *
     * @param \AppBundle\Entity\Canal $canal
     * @return CanalPorts
     */
    public function setCanal(\AppBundle\Entity\Canal $canal = null)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get canal
     *
     * @return \AppBundle\Entity\Canal 
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set port
     *
     * @param \AppBundle\Entity\Ports $port
     * @return CanalPorts
     */
    public function setPort(\AppBundle\Entity\Ports $port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return \AppBundle\Entity\Ports 
     */
    public function getPort()
    {
        return $this->port;
    }
}
