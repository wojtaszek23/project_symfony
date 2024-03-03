<?php
// src/Controller/MyHobbiesController.php
namespace App\Controller;

use App\Entity\Passions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class MyHobbiesController extends AbstractController
{
    public function main(EntityManagerInterface $entityManager) : Response
    {
        $passions = $entityManager->getRepository(Passions::class);
        $all_passions = $passions->findAll();
        return $this->render(
            'pasje/main.html.twig',
            ['passions' => $all_passions]     
        );
    }
}