<?php

use App\Controller\Accueil\AccueilAction;
use App\Controller\Produit\ListeProduitsAction;
use App\Controller\Produit\DetailProduitAction;
use App\Controller\Utilisateurs\Producteur\ListeProducteursAction;
use App\Controller\Utilisateurs\Producteur\DetailProducteurAction;


$app->get('/', AccueilAction::class);
$app->get('/nosproduits', ListeProduitsAction::class)->setName('nosproduits');
$app->get('/nosproduits/{produit}', DetailProduitAction::class)->setName('detailproduit');
$app->get('/nosproducteurs', ListeProducteursAction::class)->setName('nosproducteurs');
$app->get('/nosproducteurs/{producteur}', DetailProducteurAction::class)->setName('detailproducteur');



