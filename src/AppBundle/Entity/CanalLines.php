<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CanalLines
 *
 * @ORM\Table(name="canal_lines", indexes={@ORM\Index(name="fk_canal_lines_canal_1", columns={"canal_id"}), @ORM\Index(name="fk_canal_lines_line_1", columns={"line_id"})})
 * @ORM\Entity
 */
class CanalLines
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
     * @var \Canal
     *
     * @ORM\ManyToOne(targetEntity="Canal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="canal_id", referencedColumnName="ext_id")
     * })
     */
    private $canal;

    /**
     * @var \Line
     *
     * @ORM\ManyToOne(targetEntity="Line")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="line_id", referencedColumnName="ext_id")
     * })
     */
    private $line;



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
     * Set canal
     *
     * @param \AppBundle\Entity\Canal $canal
     * @return CanalLines
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
     * Set line
     *
     * @param \AppBundle\Entity\Line $line
     * @return CanalLines
     */
    public function setLine(\AppBundle\Entity\Line $line = null)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return \AppBundle\Entity\Line 
     */
    public function getLine()
    {
        return $this->line;
    }
}
