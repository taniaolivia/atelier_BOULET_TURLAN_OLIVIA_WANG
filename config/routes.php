<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


$app->get('/',function ($request, $response, array $args){
    return $this->get(Twig::class)->render($response,"home/index.html.twig",["session"=>$_SESSION]);
});
