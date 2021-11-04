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

    public function findProduitById(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('*')
            ->from('produit')
            ->where('idProduit = :idProduit')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProducteurByProduit(int $idProduit)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('p.idUtilisateur, u.nomUtilisateur')
            ->from('produit', 'p')
            ->where('p.idProduit = :idProduit')
            ->leftJoin('p', 'utilisateurs', 'u', 'p.idUtilisateur = u.idUtilisateur')
            ->setParameter('idProduit', $idProduit)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }
}
