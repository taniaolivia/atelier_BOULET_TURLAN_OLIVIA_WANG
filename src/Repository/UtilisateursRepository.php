<?php

namespace App\Repository;

use App\Entity\Produit;
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
            ->select('idUtilisateur, nomUtilisateur')
            ->from('Utilisateurs')
            ->where('roleId = :roleId')
            ->setParameter('roleId', $roleId)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

    public function findProducteurById(int $idUtilisateur)
    {
        $query = $this->em->getConnection()->createQueryBuilder();

        $rows = $query
            ->select('nomUtilisateur, mail, numTel')
            ->from('Utilisateurs')
            ->where('idUtilisateur = :idUtilisateur')
            ->setParameter('idUtilisateur', $idUtilisateur)
            ->execute()
            ->fetchAllAssociative();

        return $rows;
    }

}
