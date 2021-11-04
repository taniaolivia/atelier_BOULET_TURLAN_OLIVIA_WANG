<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use DI\ContainerBuilder;

use App\Controller\accueil\AccueilAction;
use App\Controller\commande\ListCommandesAction;


$app->get('/', AccueilAction::class);
$app->get('/list-commandes', ListCommandesAction::class);
