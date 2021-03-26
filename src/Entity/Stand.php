<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stand
 *
 * @ORM\Table(name="stand", indexes={@ORM\Index(name="code_exposant", columns={"code_exposant"})})
 * @ORM\Entity
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
     * @ORM\Column(name="nom", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nom = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_exposant", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codeExposant = NULL;


}
