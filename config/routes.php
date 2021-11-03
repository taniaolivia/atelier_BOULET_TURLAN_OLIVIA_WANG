<?php

use App\Controller\home\HomeAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


$app->get('/',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"accueil/accueil.html.twig");
});

$app->get('/test', HomeAction::class);

