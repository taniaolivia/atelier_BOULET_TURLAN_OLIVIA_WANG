<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ListeProduitsAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, ProduitRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $produits = $this->repository->findAllProduits();

        return $this->container->get('view')->render($this->response, 'produit/listeProduits.html.twig', ['produits' => $produits]);
    }

}