<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Organization
 *
 * @ORM\Table(name="organization")
 * @ORM\Entity
 */
class Organization
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
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="equipments", type="text", nullable=true)
     */
    private $equipments;

    /**
     * @var string
     *
     * @ORM\Column(name="org_lines", type="text", nullable=true)
     */
    private $lines;

    /**
     * @var string
     *
     * @ORM\Column(name="canals", type="text", nullable=true)
     */
    private $canals;


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
     * Set name
     *
     * @param string $name
     * @return Organization
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
     * Set equipments
     *
     * @param string $equipments
     * @return Organization
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;

        return $this;
    }

    /**
     * Get equipments
     *
     * @return string
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * Set lines
     *
     * @param string $lines
     * @return Organization
     */
    public function setLines($lines)
    {
        $this->lines = $lines;

        return $this;
    }

    /**
     * Get lines
     *
     * @return string
     */
    public function getLines()
    {
        return $this->lines;
    }


    /**
     * Set canals
     *
     * @param string $canals
     * @return Organization
     */
    public function setCanals($canals)
    {
        $this->canals = $canals;

        return $this;
    }

    /**
     * Get canals
     *
     * @return string
     */
    public function getCanals()
    {
        return $this->canals;
    }
}
