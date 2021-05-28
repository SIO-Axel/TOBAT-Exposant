<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exposant
 *
 * @ORM\Table(name="exposant")
 * @ORM\Entity(repositoryClass="App\Repository\ExposantRepository")
 */
class Exposant
{
    /**
     * @var int
     *
     * @ORM\Column(name="code_exposant", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeExposant;

    /**
     * @var string|null
     *
     * @ORM\Column(name="raison_sociale", type="string", length=50, nullable=true)
     */
    private $raisonSociale;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=true)
     */
    private $mail;

    public function getCodeExposant(): ?int
    {
        return $this->codeExposant;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(?string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }


}
