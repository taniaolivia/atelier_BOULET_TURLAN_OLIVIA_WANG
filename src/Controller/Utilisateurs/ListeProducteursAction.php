<?php
namespace App\Controller\Utilisateurs;

use App\Controller\ActionController;
use App\Repository\UtilisateursRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class ListeProducteursAction extends ActionController{

    public $container;
    public $repository;

    public function __construct(ContainerInterface $container, UtilisateursRepository $repository)
    {
        $this->container = $container;
        $this->repository = $repository;
    }

    protected function action():Response
    {
        $producteurs = $this->repository->findAllProducteursByRole(1);

        var_dump($producteurs);
        return $this->container->get('view')->render($this->response, 'utilisateurs/producteur/listeProducteurs.html.twig', ['producteurs' => $producteurs]);
    }

}