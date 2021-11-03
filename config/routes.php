<?php

use App\Controller\accueil\AccueilAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use DI\ContainerBuilder;


$app->get('/', AccueilAction::class);
