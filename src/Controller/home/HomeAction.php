<?php
namespace App\Controller\home;

use App\Controller\ActionController;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;

class HomeAction extends ActionController{

    public $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    protected function action():Response
    {
        return $this->container->get('view')->render($this->response, 'accueil/accueil.html.twig');
    }

}