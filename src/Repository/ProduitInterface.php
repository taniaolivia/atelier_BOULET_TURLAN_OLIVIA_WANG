<?php

namespace App\Repository;

use App\Entity\Produit;

interface ProduitInterface
{
    public function findAllProduits(): array;
    public function findProduitByName(string $nomProduit): Produit;

}
