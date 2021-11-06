<?php

namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Entity\Commande;
use App\Entity\Panier;
use App\Entity\Utilisateur;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;

class CommanderAction extends ActionController
{

    public $container;
    private $produitRepository;

    public function __construct(ContainerInterface $container,
                                ProduitRepository $produitRepository,
                                EntityManager $em,
                                UtilisateurRepository $utilisateurRepository, CommandeRepository $commanderepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commanderepository = $commanderepository;
        $this->em = $em;
        $this->container = $container;
        $this->produitRepository = $produitRepository;
    }

    protected function action(): Response
    {

        $this->commande($_POST);
        return $this->response
            ->withHeader('location', '/panier') // Ici il faudra rediriger vers le profil du producteur
            ->withStatus(302);
    }

    protected function commande($post)
    {

        $user = new Utilisateur(null, "ab", "ab", "ab", "ab", 0, "0670474714");
//      $this->em->persist($user);
//      $this->em->flush();
        $var = $this->utilisateurRepository->findUtilisateurByMail("a");;
        $idUtilisateur = (int)$var[0]['idUtilisateur'];
    
        $user->setIdutilisateur($idUtilisateur);

//         var_dump($user);
        $commande = new Commande(null, "12000", 0, 0, $user);
//        $this->em->persist($commande);
//        $this->em->flush();
        $panier = $_SESSION['panier'];
        var_dump($panier);
        //*find id commande*/
        $idCommande = $this->commanderepository->findCommandeOfUser($idUtilisateur);
        var_dump($idCommande);

        foreach ($panier as $ligne) {
            $idproduit = $ligne['idProduit'];
            $quantier = $ligne['quantiteProduit'];
            $paniers = new Panier(null, 1, $idCommande, 5);
        }
        $this->em->persist($paniers);
        $this->em->flush();
        return $this->response
            ->withHeader('location', '/panier') // Ici il faudra rediriger vers le profil du producteur
            ->withStatus(302);
    }

}