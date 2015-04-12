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
    private $isActiveSw = true;

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
     * @var \Ports
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ports", mappedBy="canal", cascade={"persist"})
     */
    private $beginPorts;

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
     * @var \PortsEnd
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PortsEnd", mappedBy="canal", cascade={"persist"})
     */
    private $endPorts;


    /**
     * @var \Lines
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Line", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="canal_lines",
     *      joinColumns={@ORM\JoinColumn(name="canal_id", referencedColumnName="ext_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="line_id", referencedColumnName="ext_id")}
     * )
     */
    private $lines;

    public function __construct()
    {
        $this->lines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->beginPorts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->endPorts = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set lines
     *
     * @param \AppBundle\Entity\Line $lines
     * @return Canal
     */
    public function setLines(\AppBundle\Entity\Line $lines = null)
    {
        $this->lines[] = $lines;

        return $this;
    }

    /**
     * Get lines
     *
     * @return \AppBundle\Entity\Line
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * Set ports
     *
     * @param \AppBundle\Entity\Ports $ports
     * @return Canal
     */
    public function setBeginPorts($ports = null)
    {

        foreach ($ports as $port) {
            //      dump($ports);
            $port->setCanal($this);

        }
        $this->beginPorts = $ports;

        return $this;
    }

    /**
     * Get lines
     *
     * @return Ports
     */
    public function getBeginPorts()
    {
        return $this->beginPorts;
    }

    /**
     * Set ports
     *
     * @param \AppBundle\Entity\Ports $ports
     * @return Canal
     */
    public function setEndPorts($ports = null)
    {
        foreach ($ports as $port) {
            $port->setCanal($this);
        }
        $this->endPorts = $ports;

        return $this;
    }

    /**
     * Get lines
     *
     * @return Ports
     */
    public function getEndPorts()
    {
        return $this->endPorts;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return array
     */
    static public function getPortInterfaces()
    {
        $data = array(
            '26' => 'V.24',
            '27' => 'V.35',
            '28' => 'V.36',
            '29' => 'X.21',
            '30' => 'G.703',
            '31' => 'BRI',
            '32' => 'PRI',
            '33' => '10BASE-T',
            '34' => '10BASE-F',
            '35' => '100BASE-T',
            '36' => '100BASE-SX',
            '37' => '100BASE-FX',
            '39' => '1000BASE-T',
            '23' => '1000BASE-X',
            '24' => '1000BASE-SX',
            '25' => '1000BASE-LX',
            '38' => '10GBASE-T',
            '45' => '10GBASE-LX',
            '46' => '40GBASE',
            '47' => '100GBASE',
            '40' => 'STM-1',
            '41' => 'STM-4',
            '42' => 'STM-16',
            '43' => 'STM-64',
            '44' => 'Optic',
            '51' => 'DWDM',
            '60' => 'DOCSIS',
            '61' => 'EuroDOCSIS'
        );

        return $data;
    }

    /**
     * @param $id
     * @return mixed
     */
    static public function getPortInterface($id)
    {
        $interfaces = self::getPortInterfaces();
        if (array_key_exists($id, $interfaces)) {
            return $interfaces[$id];
        }
    }

    /**
     * @return array
     */
    static public function getPortSpeedTypes()
    {
        $data = array(
            '0' => '--',
            '1' => 'kB',
            '2' => 'MB',
            '3' => 'GB'
        );

        return $data;
    }


    /**
     * @param $id
     * @return mixed
     */
    static public function getPortSpeedType($id)
    {
        $interfaces = self::getPortSpeedTypes();
        if (array_key_exists($id, $interfaces)) {
            return $interfaces[$id];
        }
    }
}
