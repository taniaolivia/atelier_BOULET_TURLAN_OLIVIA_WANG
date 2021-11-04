<?php

namespace App\Repository;

use App\Entity\Commande;
use Doctrine\ORM\EntityManager;

class CommandeRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllCommandesWithClientName(): array
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $commandes = $query
            ->select('c.*, u.nomUtilisateur')
            ->from('commande', 'c')
            ->leftJoin('c','utilisateurs','u', 'c.idUtilisateur = u.idUtilisateur')
            ->execute()
            ->fetchAllAssociative();

        return $commandes;
    }

    public function findOneById(int $id){
        
        $query = $this->em->getConnection()->createQueryBuilder();

        $commande = $query
            ->select('*')
            ->from('commande')
            ->where('idCommande=:idCommande')
            ->setParameter('idCommande',$id)
            ->execute()
            ->fetchAllAssociative();

        return $commande;
    }

    public function findProduitsDeLaCommande($idCommande): array
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $produits = $query
            ->select('p.idProduit, p.nomProduit')
            ->from('composantpanier', 'c')
            ->where('idCommande=:idCommande')
            ->setParameter('idCommande',$idCommande)
            ->leftJoin('c','produit','p', 'c.idProduit = p.idProduit')
            ->execute()
            ->fetchAllAssociative();

        return $produits;
    }

    
}
