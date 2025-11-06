<?php
// src/Controller/CulinaryRecipesController.php
namespace App\Controller;

use App\Entity\CookingRecipe;
use App\Form\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CulinaryRecipesController extends AbstractController
{
    public function main(EntityManagerInterface $entityManager): Response
    {
        $recipes = $entityManager->getRepository(CookingRecipe::class);
        $all_recipes = $recipes->findAll();
        return $this->render('przepisy/main.html.twig', [
            'recipes' => $all_recipes,
        ]);
    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new CookingRecipe();
        $form = $this->createForm(RecipeType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            if($file != null)
            {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('images_directory'),$fileName);
                $recipe->setImageName('/images/cooking_recipes/'.$fileName);
            }
            $recipe->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirect('/przepisy');
        }

        $recipes = $entityManager->getRepository(CookingRecipe::class);
        $all_recipes = $recipes->findAll();

        return $this->render('przepisy/add.html.twig', [
            'form' => $form->createView(),
            'recipes' => $all_recipes
        ]);
    }

    public function show(string $recipe, EntityManagerInterface $entityManager): Response
    {
        $recipes = $entityManager->getRepository(CookingRecipe::class);
        $all_recipes = $recipes->findAll();
        $recipe = $recipes->findOneBy(['name' => $recipe]);
        return $this->render('/przepisy/show.html.twig', [
            'chosen_recipe' => $recipe,
            'recipes' => $all_recipes
    ]);
    }
}