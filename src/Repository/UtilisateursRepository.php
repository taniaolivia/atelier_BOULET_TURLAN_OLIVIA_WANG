<?php

namespace App\Repository;

use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManager;

class UtilisateursRepository
{
    public $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findAllProducteursByRole(int $roleId)
    {
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

    public function findProducteurByName(string $nomProducteur): Utilisateurs
    {
        $producteur = $this->em->getRepository(Utilisateurs::class)->findOneBy(['nomUtilisateur'=> $nomProducteur]);
        return $producteur;
    }
}
