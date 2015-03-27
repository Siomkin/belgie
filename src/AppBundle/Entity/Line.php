<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Line
 *
 * @ORM\Table(name="line", indexes={@ORM\Index(name="fk_line_destinations_1", columns={"destinations_begin_id"}), @ORM\Index(name="fk_line_destinations_2", columns={"destinations_end_id"})})
 * @ORM\Entity
 */
class Line
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ext_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $extId;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     * @ORM\Column(name="node_length", type="integer", nullable=false)
     */
    private $nodeLength;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="cable_type", type="string", length=255, nullable=false)
     */
    private $cableType;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="cable_mark", type="string", length=255, nullable=false)
     */
    private $cableMark;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     * @ORM\Column(name="cable_cap", type="integer", nullable=false)
     */
    private $cableCap;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     * @ORM\Column(name="capacity", type="integer", nullable=false)
     */
    private $capacity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active_sw", type="boolean", nullable=false)
     */
    private $isActiveSw = true;

    /**
     * @var \Destinations
     *
     * @ORM\OneToOne(targetEntity="Destinations", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinations_begin_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $destinationsBegin;

    /**
     * @var \Destinations
     *
     * @ORM\OneToOne(targetEntity="Destinations", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinations_end_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $destinationsEnd;

    /**
     *
     */
    public function __construct()
    {
        $this->destinationsBegin = new Destinations();
        $this->destinationsEnd = new Destinations();
    }

    /**
     * Get extId
     *
     * @return integer
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Line
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Line
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nodeLength
     *
     * @param integer $nodeLength
     * @return Line
     */
    public function setNodeLength($nodeLength)
    {
        $this->nodeLength = $nodeLength;

        return $this;
    }

    /**
     * Get nodeLength
     *
     * @return integer
     */
    public function getNodeLength()
    {
        return $this->nodeLength;
    }

    /**
     * Set cableType
     *
     * @param string $cableType
     * @return Line
     */
    public function setCableType($cableType)
    {
        $this->cableType = $cableType;

        return $this;
    }

    /**
     * Get cableType
     *
     * @return string
     */
    public function getCableType()
    {
        return $this->cableType;
    }

    /**
     * Set cableMark
     *
     * @param string $cableMark
     * @return Line
     */
    public function setCableMark($cableMark)
    {
        $this->cableMark = $cableMark;

        return $this;
    }

    /**
     * Get cableMark
     *
     * @return string
     */
    public function getCableMark()
    {
        return $this->cableMark;
    }

    /**
     * Set cableCap
     *
     * @param integer $cableCap
     * @return Line
     */
    public function setCableCap($cableCap)
    {
        $this->cableCap = $cableCap;

        return $this;
    }

    /**
     * Get cableCap
     *
     * @return integer
     */
    public function getCableCap()
    {
        return $this->cableCap;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Line
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set isActiveSw
     *
     * @param boolean $isActiveSw
     * @return Line
     */
    public function setIsActiveSw($isActiveSw)
    {
        $this->isActiveSw = $isActiveSw;

        return $this;
    }

    /**
     * Get isActiveSw
     *
     * @return boolean
     */
    public function getIsActiveSw()
    {
        return $this->isActiveSw;
    }

    /**
     * Set destinationsBegin
     *
     * @param \AppBundle\Entity\Destinations $destinationsBegin
     * @return Line
     */
    public function setDestinationsBegin(\AppBundle\Entity\Destinations $destinationsBegin = null)
    {
        $this->destinationsBegin = $destinationsBegin;

        return $this;
    }

    /**
     * Get destinationsBegin
     *
     * @return \AppBundle\Entity\Destinations
     */
    public function getDestinationsBegin()
    {
        return $this->destinationsBegin;
    }

    /**
     * Set destinationsEnd
     *
     * @param \AppBundle\Entity\Destinations $destinationsEnd
     * @return Line
     */
    public function setDestinationsEnd(\AppBundle\Entity\Destinations $destinationsEnd = null)
    {
        $this->destinationsEnd = $destinationsEnd;

        return $this;
    }

    /**
     * Get destinationsEnd
     *
     * @return \AppBundle\Entity\Destinations
     */
    public function getDestinationsEnd()
    {
        return $this->destinationsEnd;
    }
}
