<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProduitAction extends ActionController{

    public $container;
    public $produitRepository;
    public $utilisateurRepository;

    public function __construct(ContainerInterface $container, ProduitRepository $produitRepository, UtilisateurRepository $utilisateurRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    protected function action():Response
    {
        $produit = $this->produitRepository->findProduitById($this->args['produit']);
        $producteur = $this->produitRepository->findProducteurByProduit($this->args['produit']);

        return $this->container->get('view')->render($this->response, 'produit/detailProduit.html.twig', ['produit' => $produit, 'producteur' => $producteur]);
    }
}