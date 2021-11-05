<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ListeProduitsAction extends ActionController{

    public $container;
    public $produitRepository;
    public $categorieRepository;

    public function __construct(ContainerInterface $container, ProduitRepository $produitRepository, CategorieRepository  $categorieRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
        $this->categorieRepository = $categorieRepository;
    }

    protected function action():Response
    {
        $produits = $this->produitRepository->findAllProduits();
        $categorie = $this->categorieRepository->findAllCategorie();

        return $this->container->get('view')->render($this->response, 'produit/listeProduits.html.twig', [
            'produits' => $produits,
            'categorie' => $categorie
        ]);
    }

}