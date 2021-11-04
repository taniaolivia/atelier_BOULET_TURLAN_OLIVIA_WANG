<?php

namespace App\Repository;

use App\Entity\Utilisateurs;

interface UtilisateursInterface
{
    public function findAllProducteursByRole(int $roleId);
    public function findProducteursByName(string $nomProducteur): Utilisateurs;

}
