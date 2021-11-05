<?php
use Slim\Routing\RouteCollectorProxy;

use App\Controller\Accueil\AccueilAction;
use App\Controller\Produit\ListeProduitsAction;
use App\Controller\Produit\DetailProduitAction;
use App\Controller\Utilisateurs\Connexion\ConnexionAction;
use App\Controller\Utilisateurs\Producteur\ListeProducteursAction;
use App\Controller\Utilisateurs\Producteur\DetailProducteurAction;
use App\Controller\Utilisateurs\Gerant\ListCommandesAction;
use App\Controller\Utilisateurs\Gerant\ViewDetailCommandAction;

use App\Controller\Panier\AjoutPanierAction;
use App\Controller\Panier\SuppressionPanierAction;

$app->get('/', AccueilAction::class);
$app->get('/nosproduits', ListeProduitsAction::class)->setName('nosproduits');
$app->get('/nosproduits/{produit}', DetailProduitAction::class)->setName('detailproduit');
$app->get('/nosproducteurs', ListeProducteursAction::class)->setName('nosproducteurs');
$app->get('/nosproducteurs/{producteur}', DetailProducteurAction::class)->setName('detailproducteur');

$app->group('/connexion', function (RouteCollectorProxy $group){
    $group->get('', function($request, $response, $args){
        return $this->get('view')->render($response, 'connexion/connexion.html.twig',[
            "session"=> $_SESSION
        ]);
    });
    $group->post('', ConnexionAction::class);
});

$app->group('/gerant', function (RouteCollectorProxy $group) {

    $group->get('/list-commandes', ListCommandesAction::class);
    $group->get('/commande/{id}', ViewDetailCommandAction::class);
});
$app->group('/panier', function (RouteCollectorProxy $group) {
    $group->get('', function($request, $response, $args){
        return $this->get('view')->render($response, 'panier/panier.html.twig',[
            "session"=> $_SESSION
        ]);
    });
    $group->post('/ajout/{id}', AjoutPanierAction::class);
    $group->post('/suppression/{id}', SuppressionPanierAction::class);
    //$group->get('/retrait/{id}', ViewDetailCommandAction::class);
});

