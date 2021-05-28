<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="stand", indexes={@ORM\Index(name="code_exposant", columns={"code_exposant"})})
 * @ORM\Entity(repositoryClass="App\Repository\StandRepository")
 */
class Stand
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_stand", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idStand;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_exposant", type="integer", nullable=true)
     */
    private $codeExposant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ouest", type="string", length=50, nullable=true)
     */
    private $ouest;
    private $est;
    private $nord;
    private $sud;

    public function getIdStand(): ?int
    {
        return $this->idStand;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeExposant(): ?int
    {
        return $this->codeExposant;
    }

    public function setCodeExposant(?int $codeExposant): self
    {
        $this->codeExposant = $codeExposant;

        return $this;
    }

    public function getOuest(): ?int
    {
        return $this->ouest;
    }

    public function setOuest(?int $ouest): self
    {
        $this->ouest = $ouest;

        return $this;
    }
    public function getEst(): ?int
    {
        return $this->est;
    }

    public function setEst(?int $est): self
    {
        $this->est = $est;

        return $this;
    }
    public function getNord(): ?int
    {
        return $this->nord;
    }

    public function setNord(?int $nord): self
    {
        $this->nord = $nord;

        return $this;
    }
    public function getSud(): ?int
    {
        return $this->sud;
    }

    public function setSud(?int $sud): self
    {
        $this->sud = $sud;

        return $this;
    }


}
