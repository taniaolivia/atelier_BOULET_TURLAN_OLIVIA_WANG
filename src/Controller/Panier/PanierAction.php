<?php
namespace App\Controller\Panier;

use App\Controller\ActionController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
class PanierAction extends ActionController {

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
        //initPranier();

        $_SESSION["ok"] = "dsfqqqqqqqqsdfqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq";

        //$commandes = $this->commandeRepository->findAll();
        return $this->container->get('view')->render($this->response, 'Panier/panier.html.twig',[
           //"commandes"=>$commandes
        ]);
    }

    protected function initPranier(){
        $erreur = false;
        $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
        if($action !== null){

            if(!in_array($action,array('ajout', 'suppression', 'refresh')))
                $erreur=true;
            //récupération des variables en POST ou GET
            $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
            $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
            $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;
            //Suppression des espaces verticaux
            $l = preg_replace('#\v#', '',$l);
            //On vérifie que $p est un float
            $p = floatval($p);
            //On traite $q qui peut être un entier simple ou un tableau d'entiers
            if (is_array($q)){
                $QteArticle = array();
                $i=0;
                foreach ($q as $contenu){
                    $QteArticle[$i++] = intval($contenu);
                }
            }
            else
                $q = intval($q);
        }
        if (!$erreur){
            switch($action){
                Case "ajout":
                    ajouterArticle($l,$q,$p);
                    break;

                Case "suppression":
                    supprimerArticle($l);
                    break;

                Case "refresh" :
                    for ($i = 0 ; $i < count($QteArticle) ; $i++)
                    {
                        modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
                    }
                    break;

                Default:
                    break;
            }
        }
    }

/**
 * Verifie si le panier existe, le crée sinon
 */
    protected function creationPanier()
    {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['libelleProduit'] = array();
            $_SESSION['panier']['qteProduit'] = array();
            $_SESSION['panier']['prixProduit'] = array();
            $_SESSION['panier']['verrou'] = false;
        }
        return true;
    }


    /**
     * Ajoute un article dans le panier
     * @param string $libelleProduit
     * @param int $qteProduit
     * @param float $prixProduit
     * @return void
     */
    protected function ajouterArticle($libelleProduit, $qteProduit, $prixProduit)
    {

        //Si le panier existe
        if (creationPanier() && !isVerrouille()) {
            //Si le produit existe déjà on ajoute seulement la quantité
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if ($positionProduit !== false) {
                $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;
            } else {
                //Sinon on ajoute le produit
                array_push($_SESSION['panier']['libelleProduit'], $libelleProduit);
                array_push($_SESSION['panier']['qteProduit'], $qteProduit);
                array_push($_SESSION['panier']['prixProduit'], $prixProduit);
            }
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }


    /**
     * Modifie la quantité d'un article
     * @param $libelleProduit
     * @param $qteProduit
     * @return void
     */
    protected function modifierQTeArticle($libelleProduit, $qteProduit)
    {
        //Si le panier existe
        if (creationPanier() && !isVerrouille()) {
            //Si la quantité est positive on modifie sinon on supprime l'article
            if ($qteProduit > 0) {
                //Recharche du produit dans le panier
                $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

                if ($positionProduit !== false) {
                    $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
                }
            } else
                supprimerArticle($libelleProduit);
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }

    /**
     * Supprime un article du panier
     * @param $libelleProduit
     */
    protected function supprimerArticle($libelleProduit)
    {
        //Si le panier existe
        if (creationPanier() && !isVerrouille()) {
            //Nous allons passer par un panier temporaire
            $tmp = array();
            $tmp['libelleProduit'] = array();
            $tmp['qteProduit'] = array();
            $tmp['prixProduit'] = array();
            $tmp['verrou'] = $_SESSION['panier']['verrou'];

            for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
                if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit) {
                    array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                    array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                    array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
                }

            }
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier'] = $tmp;
            //On efface notre panier temporaire
            unset($tmp);
        } else
            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }


    /**
     * Montant total du panier
     * @return int
     */
    protected function MontantGlobal()
    {
        $total = 0;
        for ($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
            $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
        }
        return $total;
    }


    /**
     * Fonction de suppression du panier
     * @return void
     */
    protected function supprimePanier()
    {
        unset($_SESSION['panier']);
    }

    /**
     * Permet de savoir si le panier est verrouillé
     */
    protected function isVerrouille()
    {
        if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
            return true;
        else
            return false;
    }

    /**
     * Compte le nombre d'articles différents dans le panier
     * @return int
     */
    protected function compterArticles()
    {
        if (isset($_SESSION['panier']))
            return count($_SESSION['panier']['libelleProduit']);
        else
            return 0;

    }

}

