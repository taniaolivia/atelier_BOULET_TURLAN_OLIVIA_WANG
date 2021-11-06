<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class PanierFactureAction extends ActionController{

    public $container;
    public $utilisateurRepository;
    public $commandeRepository;

    public function __construct(ContainerInterface $container, UtilisateurRepository $utilisateurRepository, CommandeRepository $commandeRepository)
    {
        $this->container = $container;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        $client = $this->utilisateurRepository->findClientById(0);
        $commandes = $this->commandeRepository->findCommandeOfUser($client[0]['idUtilisateur']);
        $sommaire = $this->commandeRepository->findOneById($commandes);
        $facture = $this->commandeRepository->findFactureByIdCom($sommaire[0]['idCommande']);

        return $this->container->get('view')->render($this->response, 'panier/facture.html.twig',[
            'client' => $client,
            'sommaire' => $sommaire,
            'facture' => $facture
        ]);
    }

}