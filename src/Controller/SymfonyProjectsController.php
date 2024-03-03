<?php
// src/Controller/SymfonyProjectsController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;


class SymfonyProjectsController
{
    public function main() : Response
    {
        return new Response("Witaj Świecie!");
    }
}