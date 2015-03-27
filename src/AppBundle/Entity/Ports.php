<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ports
 *
 * @ORM\Table(name="ports")
 * @ORM\Entity
 */
class Ports
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
     * @var integer
     *
     * @ORM\Column(name="port_id", type="integer", nullable=false)
     */
    private $portId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="interface", type="boolean", nullable=false)
     */
    private $interface;

    /**
     * @var float
     *
     * @ORM\Column(name="speed", type="float", precision=10, scale=0, nullable=false)
     */
    private $speed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;



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
     * Set portId
     *
     * @param integer $portId
     * @return Ports
     */
    public function setPortId($portId)
    {
        $this->portId = $portId;

        return $this;
    }

    /**
     * Get portId
     *
     * @return integer 
     */
    public function getPortId()
    {
        return $this->portId;
    }

    /**
     * Set interface
     *
     * @param boolean $interface
     * @return Ports
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    /**
     * Get interface
     *
     * @return boolean 
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * Set speed
     *
     * @param float $speed
     * @return Ports
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return float 
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Ports
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }
}
