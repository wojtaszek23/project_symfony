<?php
// src/Controller/WelcomeController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    public function main() : Response
    {
        return $this->render('powitanie/main.html.twig');
    }
    #[Route('/test', name: 'test')]
public function test(): Response
{
    return $this->render('test.html.twig');
}
}