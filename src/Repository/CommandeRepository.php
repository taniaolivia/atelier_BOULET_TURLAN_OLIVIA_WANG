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

    
}
