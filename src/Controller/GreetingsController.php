<?php
// src/Controller/GreetingsController.php
namespace App\Controller;

use App\Entity\Greetings;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class GreetingsController extends AbstractController
{
    public function main(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $greeting = new Greetings();
        $form = $this->createFormBuilder($greeting)
            ->add('person', TextType::class, ['label'=>'Kto jeszcze? '])
            ->add('pozdrowienia', SubmitType::Class, ['label' => 'Ja też pozdrawiam!'])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            try
            {
                $entityManager->persist($greeting);
                $entityManager->flush();
                return $this->redirect($request->getUri());
            }
            catch(\Exception $e)
            {
                return $this->render("Błąd: ".$e);
            }
        }
        

        $repository = $entityManager->getRepository(Greetings::class);
        $persons = $repository->findAll();
        return $this->render('pozdrowienia/main.html.twig', 
        [
            'form' => $form->createView(),
            'persons' => $persons
        ]);
    }
}