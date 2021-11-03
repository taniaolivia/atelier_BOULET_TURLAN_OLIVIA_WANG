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

    public function getIdcommande(): ?int
    {
        return $this->idcommande;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(?int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatutpayer(): ?bool
    {
        return $this->statutpayer;
    }

    public function setStatutpayer(?bool $statutpayer): self
    {
        $this->statutpayer = $statutpayer;

        return $this;
    }

    public function getStatutlivraison(): ?bool
    {
        return $this->statutlivraison;
    }

    public function setStatutlivraison(?bool $statutlivraison): self
    {
        $this->statutlivraison = $statutlivraison;

        return $this;
    }

    public function getIdutilisateur(): ?Utilisateurs
    {
        return $this->idutilisateur;
    }

    public function setIdutilisateur(?Utilisateurs $idutilisateur): self
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdproduit(): Collection
    {
        return $this->idproduit;
    }

    public function addIdproduit(Produit $idproduit): self
    {
        if (!$this->idproduit->contains($idproduit)) {
            $this->idproduit[] = $idproduit;
        }

        return $this;
    }

    public function removeIdproduit(Produit $idproduit): self
    {
        $this->idproduit->removeElement($idproduit);

        return $this;
    }

}
