<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coordonnee
 *
 * @ORM\Table(name="coordonnee", indexes={@ORM\Index(name="id_stand", columns={"id_stand"})})
 * @ORM\Entity(repositoryClass="App\Repository\CoordonneeRepository")
 */
class Coordonnee
{
    /**
     * @var int
     *
     * @ORM\Column(name="x", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $x;

    /**
     * @var int
     *
     * @ORM\Column(name="y", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $y;

    /**
     * @var int
     *
     * @ORM\Column(name="id_stand", type="integer", nullable=false)
     */
    private $idStand;

    public function getX(): ?int
    {
        return $this->x;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function getIdStand(): ?int
    {
        return $this->idStand;
    }

    public function setIdStand(int $idStand): self
    {
        $this->idStand = $idStand;

        return $this;
    }


}
