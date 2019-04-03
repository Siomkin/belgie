<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ports.
 *
 * @ORM\Table(name="ports_end")
 * @ORM\Entity
 */
class PortsEnd
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     * @Assert\NotBlank()
     * @ORM\Column(name="port_id", type="integer", nullable=false)
     */
    private $portId;

    /**
     * @var int
     * @Assert\NotBlank()
     * @ORM\Column(name="interface", type="integer", nullable=false)
     */
    private $interface;

    /**
     * @var float
     * @Assert\NotBlank()
     * @ORM\Column(name="speed", type="float", precision=10, scale=0, nullable=false)
     */
    private $speed;

    /**
     * @var int
     * @Assert\NotBlank()
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;

    /**
     * @var Canal
     *
     * @ORM\ManyToOne(targetEntity="Canal", inversedBy="endPorts", cascade={"persist"})
     * @ORM\JoinColumn(name="canal_id", referencedColumnName="ext_id")
     */
    private $canal;

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
     * Set portId.
     *
     * @param int $portId
     *
     * @return PortsEnd
     */
    public function setPortId($portId)
    {
        $this->portId = $portId;

        return $this;
    }

    /**
     * Get portId.
     *
     * @return int
     */
    public function getPortId()
    {
        return $this->portId;
    }

    /**
     * Set interface.
     *
     * @param int $interface
     *
     * @return PortsEnd
     */
    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    /**
     * Get interface.
     *
     * @return int
     */
    public function getInterface()
    {
        return $this->interface;
    }

    /**
     * Set speed.
     *
     * @param float $speed
     *
     * @return PortsEnd
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed.
     *
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return PortsEnd
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type.
     *
     * @param $canal
     *
     * @return PortsEnd
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get type.
     *
     * @return Canal
     */
    public function getCanal()
    {
        return $this->canal;
    }
}
