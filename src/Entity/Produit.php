<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_produit_utilisateur", columns={"idUtilisateur"}), @ORM\Index(name="FK_produit_categorie", columns={"idCategorie"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProduit", type="string", length=255, nullable=false)
     */
    private $nomproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="tarifUnitaire", type="integer", nullable=false)
     */
    private $tarifunitaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lienImage", type="string", length=255, nullable=true)
     */
    private $lienimage;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorie", referencedColumnName="idCategorie")
     * })
     */
    private $idcategorie;

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
     * @ORM\ManyToMany(targetEntity="Commande", mappedBy="idproduit")
     */
    private $idcommande;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idcommande = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function getNomproduit(): ?string
    {
        return $this->nomproduit;
    }

    public function setNomproduit(string $nomproduit): self
    {
        $this->nomproduit = $nomproduit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTarifunitaire(): ?int
    {
        return $this->tarifunitaire;
    }

    public function setTarifunitaire(int $tarifunitaire): self
    {
        $this->tarifunitaire = $tarifunitaire;

        return $this;
    }

    public function getLienimage(): ?string
    {
        return $this->lienimage;
    }

    public function setLienimage(?string $lienimage): self
    {
        $this->lienimage = $lienimage;

        return $this;
    }

    public function getIdcategorie(): ?Categorie
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?Categorie $idcategorie): self
    {
        $this->idcategorie = $idcategorie;

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
     * @return Collection|Commande[]
     */
    public function getIdcommande(): Collection
    {
        return $this->idcommande;
    }

    public function addIdcommande(Commande $idcommande): self
    {
        if (!$this->idcommande->contains($idcommande)) {
            $this->idcommande[] = $idcommande;
            $idcommande->addIdproduit($this);
        }

        return $this;
    }

    public function removeIdcommande(Commande $idcommande): self
    {
        if ($this->idcommande->removeElement($idcommande)) {
            $idcommande->removeIdproduit($this);
        }

        return $this;
    }

}
