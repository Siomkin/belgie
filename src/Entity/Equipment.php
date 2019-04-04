<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Equipment.
 *
 * @ORM\Table(name="equipment", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_code", columns={"code"})},
 *  indexes={
 *      @ORM\Index(name="fk_equipment_equipment_type_1", columns={"type_id"}),
 *      @ORM\Index(name="fk_equipment_destinations_1", columns={"destinations_id"})
 *  })
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 * @UniqueEntity("code")
 */
class Equipment
{
    public const NUM_ITEMS = 50;

    /**
     * @var int
     *
     * @ORM\Column(name="ext_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $extId;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="code", type="string", length=255, unique=true, nullable=false)
     */
    private $code;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="vendor", type="string", length=255, nullable=false)
     */
    private $vendor;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var bool
     * @ORM\Column(name="is_active_sw", type="boolean", nullable=false)
     */
    private $isActiveSw = true;

    /**
     * @var Destinations
     * @Assert\NotNull()
     * @ORM\OneToOne(targetEntity="Destinations", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destinations_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $destinations;

    /**
     * @var EquipmentType
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="EquipmentType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    public function __construct()
    {
        $this->destinations = new Destinations();
    }

    /**
     * Get extId.
     *
     * @return int
     */
    public function getExtId()
    {
        return $this->extId;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Equipment
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set vendor.
     *
     * @param string $vendor
     *
     * @return Equipment
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get vendor.
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Set model.
     *
     * @param string $model
     *
     * @return Equipment
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set isActiveSw.
     *
     * @param bool $isActiveSw
     *
     * @return Equipment
     */
    public function setIsActiveSw($isActiveSw)
    {
        $this->isActiveSw = $isActiveSw;

        return $this;
    }

    /**
     * Get isActiveSw.
     *
     * @return bool
     */
    public function getIsActiveSw()
    {
        return $this->isActiveSw;
    }

    /**
     * Set destinations.
     *
     * @param \App\Entity\Destinations $destinations
     *
     * @return Equipment
     */
    public function setDestinationsBegin(\App\Entity\Destinations $destinations = null)
    {
        $this->destinations = $destinations;

        return $this;
    }

    /**
     * Get destinations.
     *
     * @return \App\Entity\Destinations
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * Set type.
     *
     * @param \App\Entity\EquipmentType $type
     *
     * @return Equipment
     */
    public function setType(\App\Entity\EquipmentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return \App\Entity\EquipmentType
     */
    public function getType()
    {
        return $this->type;
    }

    public function __toString()
    {
        return $this->getCode().' - '.$this->getVendor().' '.$this->getModel();
    }
}
