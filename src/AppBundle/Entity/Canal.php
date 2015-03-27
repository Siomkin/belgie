<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Canal
 *
 * @ORM\Table(name="canal", indexes={@ORM\Index(name="fk_canal_equipment_1", columns={"begin_equip_id"}), @ORM\Index(name="fk_canal_equipment_2", columns={"end_equip_id"})})
 * @ORM\Entity
 */
class Canal
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active_sw", type="boolean", nullable=false)
     */
    private $isActiveSw = '1';

    /**
     * @var \Equipment
     *
     * @ORM\ManyToOne(targetEntity="Equipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="begin_equip_id", referencedColumnName="ext_id")
     * })
     */
    private $beginEquip;

    /**
     * @var \Equipment
     *
     * @ORM\ManyToOne(targetEntity="Equipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="end_equip_id", referencedColumnName="ext_id")
     * })
     */
    private $endEquip;



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
     * @return Canal
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
     * Set isActiveSw
     *
     * @param boolean $isActiveSw
     * @return Canal
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
     * Set beginEquip
     *
     * @param \AppBundle\Entity\Equipment $beginEquip
     * @return Canal
     */
    public function setBeginEquip(\AppBundle\Entity\Equipment $beginEquip = null)
    {
        $this->beginEquip = $beginEquip;

        return $this;
    }

    /**
     * Get beginEquip
     *
     * @return \AppBundle\Entity\Equipment 
     */
    public function getBeginEquip()
    {
        return $this->beginEquip;
    }

    /**
     * Set endEquip
     *
     * @param \AppBundle\Entity\Equipment $endEquip
     * @return Canal
     */
    public function setEndEquip(\AppBundle\Entity\Equipment $endEquip = null)
    {
        $this->endEquip = $endEquip;

        return $this;
    }

    /**
     * Get endEquip
     *
     * @return \AppBundle\Entity\Equipment 
     */
    public function getEndEquip()
    {
        return $this->endEquip;
    }
}
