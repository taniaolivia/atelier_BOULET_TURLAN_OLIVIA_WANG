<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class RechercheProduitsAction extends ActionController{

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
        $categorie = $this->categorieRepository->findAllCategorie();
        $recherche = $this->produitRepository->findSelectedCategorie($this->args['categories']);

        return $this->container->get('view')->render($this->response, 'produit/listeProduitsRecherche.html.twig', [
            'recherche' => $recherche,
            'categorie' => $categorie
        ]);
    }

}