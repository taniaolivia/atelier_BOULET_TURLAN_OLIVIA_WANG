<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use App\Repository\CommandeRepository;
use App\Repository\UtilisateurRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class PanierInfoLivraisonAction extends ActionController{

    public $container;
    public $utilisateurRepository;
    public $commandeRepository;

    public function __construct(ContainerInterface $container, UtilisateurRepository $utilisateurRepository, CommandeRepository  $commandeRepository)
    {
        $this->container = $container;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->commandeRepository = $commandeRepository;
    }

    protected function action():Response
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
                $nom = htmlentities($_POST['nom']);
                $mail = htmlentities($_POST['mail']);
                $numTel = htmlentities($_POST['numTel']);
                $adresse = htmlentities($_POST['adresse']);
                $montant = htmlentities($_POST['montant']);

                $idCommande = $this->commandeRepository->findCommandeByMontant($montant);

                $this->utilisateurRepository->addClientInfo($nom, $numTel, $mail, $adresse);

                $mails = $this->utilisateurRepository->findUtilisateurByMail($mail);

                $this->commandeRepository->addUser($idCommande, $mails[0]['idUtilisateur']);

                return $this->response->withHeader('Location','/panier/info/facture');

        }
        else
        {
            return $this->container->get('view')->render($this->response, 'panier/infoLivraison.html.twig',[

            ]);
        }


    }

}