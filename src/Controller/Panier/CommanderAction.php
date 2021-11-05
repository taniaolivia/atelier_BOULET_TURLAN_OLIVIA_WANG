<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class CommanderAction extends ActionController{

    public $container;
    private $produitRepository;

    public function __construct(ContainerInterface $container,ProduitRepository $produitRepository)
    {
        $this->container = $container;
        $this->produitRepository = $produitRepository;
    }

    protected function  action():Response
    {

        $this->registerUser($_POST);
        commande();
//        $produitId = (int) $this->args['id'];
//        //$group = $this->groupRepository->find($groupId);
//        $parsedBody = $this->request->getParsedBody();
//        $quantite = htmlspecialchars($parsedBody['quantite']);
//        if (isset($_SESSION['panier'])){
//            $panier = ($_SESSION['panier']);
//            $nouveauPanier = [];
//            foreach ($panier as $ligne) {
//                if($ligne['idProduit'] != $produitId && $ligne['quantiteProduit'] != $quantite){
//
//                }
//            }
//        }
//        $_SESSION['panier'] = $nouveauPanier;
//
        return $this->response
            ->withHeader('location','/panier') // Ici il faudra rediriger vers le profil du producteur
            ->withStatus(302);
    }
    protected function  commande($post)
    {
        echo $post;
//        $produitId = (int) $this->args['id'];
//        //$group = $this->groupRepository->find($groupId);
//        $parsedBody = $this->request->getParsedBody();
//        $quantite = htmlspecialchars($parsedBody['quantite']);
//        if (isset($_SESSION['panier'])){
//            $panier = ($_SESSION['panier']);
//            $nouveauPanier = [];
//            foreach ($panier as $ligne) {
//                if($ligne['idProduit'] != $produitId && $ligne['quantiteProduit'] != $quantite){
//
//                }
//            }
//        }
//        $_SESSION['panier'] = $nouveauPanier;

//        return $this->response
//            ->withHeader('location','/panier') // Ici il faudra rediriger vers le profil du producteur
//            ->withStatus(302);
    }

}