<?php

use App\Controller\home\HomeAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


<<<<<<< HEAD
$app->get('/', \App\Controller\UserController::class . ':test');
=======
$app->get('/',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"home/index.html.twig");
});

$app->get('/test', HomeAction::class);

>>>>>>> 3bbfcc898be19e15bbf468b85d30c384f040848f
