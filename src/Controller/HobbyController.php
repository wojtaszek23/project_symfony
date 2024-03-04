<?php
// src/Controller/HobbyController.php
namespace App\Controller;

use App\Entity\Passions;
use App\Entity\PassionItems;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HobbyController extends AbstractController
{
    public function main(string $passion, EntityManagerInterface $entityManager) : Response
    {
        $passions = $entityManager->getRepository(Passions::class);
        /*if(!($passions->contains($passion)))
        {
            return $this->redirect('/zainteresowania');
        }*/
        $found = $passions->findOneBy(['name' => $passion]);
        if($found == null)
        {
            return $this->redirect('/zainteresowania');
        }
        $passionItems = $found->getPassionItems();
        return $this->render('pasja/main.html.twig', 
        [
            'passion_name' => $found->getName(),
            'passion_description' => $found->getDescription(),
            'passionItems' => $passionItems 
        ]);
        //return new Response("udało się");
    }
}