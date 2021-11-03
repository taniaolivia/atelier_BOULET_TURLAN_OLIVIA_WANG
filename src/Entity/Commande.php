<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_commande_utilisateur", columns={"idUtilisateur"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var string
     *
     * @ORM\Column(name="nomClient", type="string", length=255, nullable=false)
     */
    private $nomclient;

    /**
     * @var string
     *
     * @ORM\Column(name="mailClient", type="string", length=255, nullable=false)
     */
    private $mailclient;

    /**
     * @var int
     *
     * @ORM\Column(name="telClient", type="integer", nullable=false)
     */
    private $telclient;

    /**
     * @var int|null
     *
     * @ORM\Column(name="montant", type="integer", nullable=true)
     */
    private $montant;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="statutPayer", type="boolean", nullable=true)
     */
    private $statutpayer;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="statutLivraison", type="boolean", nullable=true)
     */
    private $statutlivraison;

    /**
     * @var \Utilisateurs
     *
     * @ORM\ManyToOne(targetEntity="Utilisateurs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtilisateur", referencedColumnName="idUtilisateur")
     * })
     */
    private $idutilisateur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="idcommande")
     * @ORM\JoinTable(name="composantpanier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idCommande", referencedColumnName="idCommande")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idProduit", referencedColumnName="idProduit")
     *   }
     * )
     */
    private $idproduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idproduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdcommande()
    {
        return $this->idcommande;
    }

    public function getNomclient()
    {
        return $this->nomclient;
    }

    public function setNomclient( $nomclient)
    {
        $this->nomclient = $nomclient;

        return $this;
    }

    public function getMailclient()
    {
        return $this->mailclient;
    }

    public function setMailclient( $mailclient)
    {
        $this->mailclient = $mailclient;

        return $this;
    }

    public function getTelclient()
    {
        return $this->telclient;
    }

    public function setTelclient( $telclient)
    {
        $this->telclient = $telclient;

        return $this;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setMontant( $montant)
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatutpayer()
    {
        return $this->statutpayer;
    }

    public function setStatutpayer( $statutpayer)
    {
        $this->statutpayer = $statutpayer;

        return $this;
    }

    public function getStatutlivraison()
    {
        return $this->statutlivraison;
    }

    public function setStatutlivraison( $statutlivraison)
    {
        $this->statutlivraison = $statutlivraison;

        return $this;
    }

    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(Utilisateurs $idutilisateur)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdproduit()
    {
        return $this->idproduit;
    }

    public function addIdproduit(Produit $idproduit)
    {
        if (!$this->idproduit->contains($idproduit)) {
            $this->idproduit[] = $idproduit;
        }

        return $this;
    }

    public function removeIdproduit(Produit $idproduit)
    {
        $this->idproduit->removeElement($idproduit);

        return $this;
    }

}
