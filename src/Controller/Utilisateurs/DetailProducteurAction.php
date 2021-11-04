<?php
namespace App\Controller\Utilisateurs;

use App\Controller\ActionController;
use App\Repository\UtilisateursRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class DetailProducteurAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, UtilisateursRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $produit = $this->repository->findProduitByName($this->args['produit']);

        return $this->container->get('view')->render($this->response, 'utilisateurs/produit/detailProducteur.html.twig', ['produit' => $produit]);
    }
}