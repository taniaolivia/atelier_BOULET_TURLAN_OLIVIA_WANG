<?php
namespace App\Controller\Produit;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProduitAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, ProduitRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $produit = $this->repository->findProduitByName($this->args['produit']);

        return $this->container->get('view')->render($this->response, 'produit/detailProduit.html.twig', ['produit' => $produit]);
    }
}