<?php
// src/Controller/HobbyItemController.php
namespace App\Controller;

use App\Entity\Passions;
use App\Entity\PassionItems;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HobbyItemController extends AbstractController
{
    public function main(string $passion, string $passionItem, EntityManagerInterface $entityManager) : Response
    {
        $passions = $entityManager->getRepository(Passions::class);
        $passion = $passions->findOneBy(['name' => $passion]);
        $items = $entityManager->getRepository(PassionItems::class);
        $item = $items->findOneBy(['name' => $passionItem]);
        return $this->render(
            'przedmiot pasji/main.html.twig',
            [
                'passion_item' => $item,
                'passion' => $passion
            ]     
        );
    }
}