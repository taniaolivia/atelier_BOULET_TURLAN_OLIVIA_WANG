<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\Entity
 */
class Utilisateurs
{
    /**
     * @var int
     *
     * @ORM\Column(name="idUtilisateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idutilisateur;

    /**
     * @var string
     *
     * @ORM\Column(name="nomUtilisateur", type="string", length=255, nullable=false)
     */
    private $nomutilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="localisation", type="string", length=255, nullable=true)
     */
    private $localisation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=255, nullable=false)
     */
    private $motdepasse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function getNomutilisateur()
    {
        return $this->nomutilisateur;
    }

    public function setNomutilisateur( $nomutilisateur)
    {
        $this->nomutilisateur = $nomutilisateur;

        return $this;
    }

    public function getLocalisation()
    {
        return $this->localisation;
    }

    public function setLocalisation( $localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail( $mail)
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    public function setMotdepasse( $motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole( $role)
    {
        $this->role = $role;

        return $this;
    }


}
