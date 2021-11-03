<?php
declare(strict_types=1);

namespace App\Repository;
use App\Entity\Commande;

interface CommandeRepository
{
    /**
     * @return Commande[]
     */
    public function findAll(): array;

    /**
     * @param  int $id
     * @return Commande
     * @throws CommandeNotFoundException
     */
    public function findCommandeOfId(int $id): Commande;
}
