<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManager;

class UtilisateursRepository implements UtilisateursInterface
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllProducteursByRole(int $roleId)
    {
        //$utilisateurs = $this->em->getRepository(Utilisateurs::class)->findAll();
        //return $utilisateurs;
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('nomUtilisateur')
            ->from('Utilisateurs')
            ->where('roleId = :roleId')
            ->setParameter('roleId', $roleId)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProducteursByName(string $nomProduit): Utilisateurs
    {
        $produit = $this->em->getRepository(Produit::class)->findOneBy(['nomproduit'=> $nomProduit]);
        return $produit;
    }
}
