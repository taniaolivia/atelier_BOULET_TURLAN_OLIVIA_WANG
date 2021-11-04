<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\ORM\EntityManager;

class ProduitRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllProduits(): array
    {
        $produits = $this->em->getRepository(Produit::class)->findAll();
        return $produits;
    }

    public function findProduitByName(string $nomProduit): Produit
    {
        $produit = $this->em->getRepository(Produit::class)->findOneBy(['nomproduit'=> $nomProduit]);
        return $produit;
    }
}
