<?php
// src/Controller/SnakeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SnakeController extends AbstractController
{
    public function main() : Response
    {
        return $this->render('snake/main.html.twig');
    }
}