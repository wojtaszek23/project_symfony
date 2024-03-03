<?php
// src/Controller/CulinaryRecipesController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CulinaryRecipesController
{
    public function main() : Response
    {
        return new Response("Przepisy kucharskie w budowie...");
    }
}