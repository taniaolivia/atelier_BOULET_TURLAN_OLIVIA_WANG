<?php
namespace App\Controller\commande;

use App\Controller\ActionController;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class ListCommandesAction extends ActionController{

    public $container;
    private $em;
    private $commandeRepository;

    public function __construct(ContainerInterface $container,EntityManager $em)
    {
        $this->container = $container;
        $this->em = $em;
        $this->commandeRepository = $em->getRepository('App\Entity\Commande');
    }

    protected function action():Response
    {
        $commandes = $this->commandeRepository->findAll();
        return $this->container->get('view')->render($this->response, 'commande/listCommandes.html.twig',[
            "commandes"=>$commandes
        ]);                
    }

}