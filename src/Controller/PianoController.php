<?php
// src/Controller/PianoController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PianoController extends AbstractController
{
    public function main() : Response
    {
        return $this->render('piano/main.html.twig');
    }
}