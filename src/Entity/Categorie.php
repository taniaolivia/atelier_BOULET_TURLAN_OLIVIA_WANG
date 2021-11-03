<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCategorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCategorie", type="string", length=255, nullable=false)
     */
    private $nomcategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    public function getNomcategorie()
    {
        return $this->nomcategorie;
    }

    public function setNomcategorie( $nomcategorie)
    {
        $this->nomcategorie = $nomcategorie;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription( $description)
    {
        $this->description = $description;

        return $this;
    }


}
