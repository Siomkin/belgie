<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CanalLines.
 *
 * @ORM\Table(name="canal_lines", indexes={@ORM\Index(name="fk_canal_lines_canal_1", columns={"canal_id"}), @ORM\Index(name="fk_canal_lines_line_1", columns={"line_id"})})
 * @ORM\Entity
 */
class CanalLines
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
     * @var Canal
     *
     * @ORM\ManyToOne(targetEntity="Canal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="canal_id", referencedColumnName="ext_id")
     * })
     */
    private $canal;

    /**
     * @var Line
     *
     * @ORM\ManyToOne(targetEntity="Line")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="line_id", referencedColumnName="ext_id")
     * })
     */
    private $line;

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
     * Set canal.
     *
     * @param \App\Entity\Canal $canal
     *
     * @return CanalLines
     */
    public function setCanal(\App\Entity\Canal $canal = null)
    {
        $this->canal = $canal;

        return $this;
    }

    /**
     * Get canal.
     *
     * @return \App\Entity\Canal
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set line.
     *
     * @param \App\Entity\Line $line
     *
     * @return CanalLines
     */
    public function setLine(\App\Entity\Line $line = null)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line.
     *
     * @return \App\Entity\Line
     */
    public function getLine()
    {
        return $this->line;
    }
}
