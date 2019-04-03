<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Destinations.
 *
 * @ORM\Table(name="destinations", indexes={@ORM\Index(name="fk_address_city_1", columns={"address_city_id"}), @ORM\Index(name="fk_address_region_1", columns={"address_region_id"}), @ORM\Index(name="fk_address_street_1", columns={"address_street_id"})})
 * @ORM\Entity
 */
class Destinations
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
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=true)
     */
    private $type = false;

    /**
     * @var int
     * @Assert\NotBlank(groups={"address"})
     * @ORM\Column(name="address_index", type="integer", nullable=true)
     */
    private $addressIndex = '212000';

    /**
     * @var string
     * @Assert\NotBlank(groups={"address"})
     * @ORM\Column(name="address_building_number", type="string", length=10, nullable=true)
     */
    private $addressBuildingNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address_office_number", type="string", length=20, nullable=true)
     */
    private $addressOfficeNumber;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="latitude_deg", type="string", length=3, nullable=true)
     */
    private $latitudeDeg;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="latitude_min", type="string", length=3, nullable=true)
     */
    private $latitudeMin;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="latitude_sec", type="string", length=3, nullable=true)
     */
    private $latitudeSec;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="longitude_deg", type="string", length=3, nullable=true)
     */
    private $longitudeDeg;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="longitude_min", type="string", length=3, nullable=true)
     */
    private $longitudeMin;

    /**
     * @var string
     * @Assert\NotBlank(groups={"latitude"})
     * @ORM\Column(name="longitude_sec", type="string", length=3, nullable=true)
     */
    private $longitudeSec;

    /**
     * @var City
     * @Assert\NotNull(groups={"address"})
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_city_id", referencedColumnName="id")
     * })
     */
    private $addressCity;

    /**
     * @var Region
     * @Assert\NotNull(groups={"address"})
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_region_id", referencedColumnName="id")
     * })
     */
    private $addressRegion;

    /**
     * @var Street
     * @Assert\NotNull(groups={"address"})
     * @ORM\ManyToOne(targetEntity="Street")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_street_id", referencedColumnName="id")
     * })
     */
    private $addressStreet;

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
     * Set type.
     *
     * @param bool $type
     *
     * @return Destinations
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set addressIndex.
     *
     * @param int $addressIndex
     *
     * @return Destinations
     */
    public function setAddressIndex($addressIndex)
    {
        $this->addressIndex = $addressIndex;

        return $this;
    }

    /**
     * Get addressIndex.
     *
     * @return int
     */
    public function getAddressIndex()
    {
        return $this->addressIndex;
    }

    /**
     * Set addressBuildingNumber.
     *
     * @param string $addressBuildingNumber
     *
     * @return Destinations
     */
    public function setAddressBuildingNumber($addressBuildingNumber)
    {
        $this->addressBuildingNumber = $addressBuildingNumber;

        return $this;
    }

    /**
     * Get addressBuildingNumber.
     *
     * @return string
     */
    public function getAddressBuildingNumber()
    {
        return $this->addressBuildingNumber;
    }

    /**
     * Set addressOfficeNumber.
     *
     * @param string $addressOfficeNumber
     *
     * @return Destinations
     */
    public function setAddressOfficeNumber($addressOfficeNumber)
    {
        $this->addressOfficeNumber = $addressOfficeNumber;

        return $this;
    }

    /**
     * Get addressOfficeNumber.
     *
     * @return string
     */
    public function getAddressOfficeNumber()
    {
        return $this->addressOfficeNumber;
    }

    /**
     * Set latitudeDeg.
     *
     * @param string $latitudeDeg
     *
     * @return Destinations
     */
    public function setLatitudeDeg($latitudeDeg)
    {
        $this->latitudeDeg = $latitudeDeg;

        return $this;
    }

    /**
     * Get latitudeDeg.
     *
     * @return string
     */
    public function getLatitudeDeg()
    {
        return $this->latitudeDeg;
    }

    /**
     * Set latitudeMin.
     *
     * @param string $latitudeMin
     *
     * @return Destinations
     */
    public function setLatitudeMin($latitudeMin)
    {
        $this->latitudeMin = $latitudeMin;

        return $this;
    }

    /**
     * Get latitudeMin.
     *
     * @return string
     */
    public function getLatitudeMin()
    {
        return $this->latitudeMin;
    }

    /**
     * Set latitudeSec.
     *
     * @param string $latitudeSec
     *
     * @return Destinations
     */
    public function setLatitudeSec($latitudeSec)
    {
        $this->latitudeSec = $latitudeSec;

        return $this;
    }

    /**
     * Get latitudeSec.
     *
     * @return string
     */
    public function getLatitudeSec()
    {
        return $this->latitudeSec;
    }

    /**
     * Set longitudeDeg.
     *
     * @param string $longitudeDeg
     *
     * @return Destinations
     */
    public function setLongitudeDeg($longitudeDeg)
    {
        $this->longitudeDeg = $longitudeDeg;

        return $this;
    }

    /**
     * Get longitudeDeg.
     *
     * @return string
     */
    public function getLongitudeDeg()
    {
        return $this->longitudeDeg;
    }

    /**
     * Set longitudeMin.
     *
     * @param string $longitudeMin
     *
     * @return Destinations
     */
    public function setLongitudeMin($longitudeMin)
    {
        $this->longitudeMin = $longitudeMin;

        return $this;
    }

    /**
     * Get longitudeMin.
     *
     * @return string
     */
    public function getLongitudeMin()
    {
        return $this->longitudeMin;
    }

    /**
     * Set longitudeSec.
     *
     * @param string $longitudeSec
     *
     * @return Destinations
     */
    public function setLongitudeSec($longitudeSec)
    {
        $this->longitudeSec = $longitudeSec;

        return $this;
    }

    /**
     * Get longitudeSec.
     *
     * @return string
     */
    public function getLongitudeSec()
    {
        return $this->longitudeSec;
    }

    /**
     * Set addressCity.
     *
     * @param \App\Entity\City $addressCity
     *
     * @return Destinations
     */
    public function setAddressCity(\App\Entity\City $addressCity = null)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity.
     *
     * @return \App\Entity\City
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressRegion.
     *
     * @param \App\Entity\Region $addressRegion
     *
     * @return Destinations
     */
    public function setAddressRegion(\App\Entity\Region $addressRegion = null)
    {
        $this->addressRegion = $addressRegion;

        return $this;
    }

    /**
     * Get addressRegion.
     *
     * @return \App\Entity\Region
     */
    public function getAddressRegion()
    {
        return $this->addressRegion;
    }

    /**
     * Set addressStreet.
     *
     * @param \App\Entity\Street $addressStreet
     *
     * @return Destinations
     */
    public function setAddressStreet(\App\Entity\Street $addressStreet = null)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet.
     *
     * @return \App\Entity\Street
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        if ($this->type) {
            return $this->getLatitudeDeg().', '.$this->getLatitudeMin().', '.$this->getLatitudeSec()
            .', '.$this->getLongitudeDeg().', '.$this->getLongitudeMin().', '.$this->getLongitudeSec();
        }

        return $this->getAddressCity()->getName().', '.$this->getAddressRegion()->getName().', '.
            $this->getAddressIndex().', '.$this->getAddressStreet()->getName().', '.$this->getAddressBuildingNumber(
            ).', '.$this->getAddressOfficeNumber();
    }
}
