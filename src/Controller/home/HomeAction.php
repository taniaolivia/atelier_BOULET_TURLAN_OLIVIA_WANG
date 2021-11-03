<?php
namespace App\Controller\home;

use App\Controller\ActionController;

use Psr\Http\Message\ResponseInterface as Response;

class HomeAction extends ActionController{

    protected function action():Response
    {        
        $this->response->getBody()->write("Hello");
        return $this->response;
    }
    public function __construct()
    {
    }
}