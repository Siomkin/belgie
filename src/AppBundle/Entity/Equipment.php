<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 *
 * @ORM\Table(name="equipment", indexes={@ORM\Index(name="fk_equipment_equipment_type_1", columns={"type_id"}), @ORM\Index(name="fk_equipment_destinations_1", columns={"destinations_id"})})
 * @ORM\Entity
 */
class Equipment
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
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor", type="string", length=255, nullable=false)
     */
    private $vendor;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active_sw", type="boolean", nullable=false)
     */
    private $isActiveSw = true;

    /**
     * @var \Destinations
     *
     * @ORM\OneToOne(targetEntity="Destinations", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinations_id", referencedColumnName="id")
     * })
     */
    private $destinations;

    /**
     * @var \EquipmentType
     *
     * @ORM\ManyToOne(targetEntity="EquipmentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     *
     */
    public function __construct()
    {
        $this->destinations = new Destinations();
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
     * Set code
     *
     * @param string $code
     * @return Equipment
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
     * Set vendor
     *
     * @param string $vendor
     * @return Equipment
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Equipment
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set isActiveSw
     *
     * @param boolean $isActiveSw
     * @return Equipment
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
     * Set destinations
     *
     * @param  $destinations
     * @return Equipment
     */
    public function setDestinations( $destinations = null)
    {
       // $this->destinations = new Destinations();
        $this->destinations=$destinations;

        return $this;
    }

    /**
     * Get destinations
     *
     * @return \AppBundle\Entity\Destinations
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\EquipmentType $type
     * @return Equipment
     */
    public function setType(\AppBundle\Entity\EquipmentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\EquipmentType
     */
    public function getType()
    {
        return $this->type;
    }
}