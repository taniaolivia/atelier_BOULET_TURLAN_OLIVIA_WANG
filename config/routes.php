<?php

use Slim\Routing\RouteCollectorProxy;

use App\Controller\Accueil\AccueilAction;
use App\Controller\Produit\ListeProduitsAction;
use App\Controller\Produit\DetailProduitAction;
use App\Controller\Utilisateurs\Producteur\ListeProducteursAction;
use App\Controller\Utilisateurs\Producteur\DetailProducteurAction;
use App\Controller\Produit\RechercheProduitsAction;
use App\Controller\Utilisateurs\Gerant\ListCommandesAction;
use App\Controller\Utilisateurs\Gerant\ViewDetailCommandAction;

$app->get('/', AccueilAction::class);
$app->get('/nosproduits', ListeProduitsAction::class)->setName('nosproduits');
$app->get('/nosproduits/{produit}', DetailProduitAction::class)->setName('detailproduit');
$app->get('/nosproduits/recherche/{categories}', RechercheProduitsAction::class)->setName('recherchecategorie');
$app->get('/nosproducteurs', ListeProducteursAction::class)->setName('nosproducteurs');
$app->get('/nosproducteurs/{producteur}', DetailProducteurAction::class)->setName('detailproducteur');

$app->group('/gerant', function (RouteCollectorProxy $group) {

    $group->get('/list-commandes', ListCommandesAction::class);
    $group->get('/commande/{id}', ViewDetailCommandAction::class);

});

