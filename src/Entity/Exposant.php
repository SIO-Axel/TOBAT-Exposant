<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exposant
 *
 * @ORM\Table(name="exposant")
 * @ORM\Entity
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
     * @ORM\Column(name="raison_sociale", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $raisonSociale = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $telephone = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $mail = 'NULL';


}
