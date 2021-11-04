<?php
use Slim\Routing\RouteCollectorProxy;

use App\Controller\Accueil\AccueilAction;
use App\Controller\Produit\ListeProduitsAction;
use App\Controller\Produit\DetailProduitAction;
use App\Controller\Utilisateurs\Producteur\ListeProducteursAction;
use App\Controller\Utilisateurs\Producteur\DetailProducteurAction;
use App\Controller\Utilisateurs\Gerant\ListCommandesAction;

$app->get('/', AccueilAction::class);
$app->get('/nosproduits', ListeProduitsAction::class)->setName('nosproduits');
$app->get('/nosproduits/{produit}', DetailProduitAction::class)->setName('detailproduit');
$app->get('/nosproducteurs', ListeProducteursAction::class)->setName('nosproducteurs');
$app->get('/nosproducteurs/{producteur}', DetailProducteurAction::class)->setName('detailproducteur');

$app->group('/gerant', function (RouteCollectorProxy $group) {

    $group->get('/list-commandes', ListCommandesAction::class);
});

