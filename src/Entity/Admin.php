<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @ORM\Table(name="admin")
 * @ORM\Entity
 */
class Admin
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_admin", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdmin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mot_de_passe", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $motDePasse = 'NULL';


}
