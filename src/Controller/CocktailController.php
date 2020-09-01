<?php

namespace App\Controller;

use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use App\Entity\Cocktail;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
// use http\Env\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CocktailController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CocktailRepository $repo)
    {
        $cocktails = $repo->findAll();

        return $this->render('cocktail/index.html.twig', [
            'controller_name' => 'CocktailController',
            'cocktails' => $cocktails
        ]);
    }

    /**
     * @Route("/cocktail/{id}", name="cocktail_show")
     */
    public function show(Cocktail $cocktail){

        return $this->render('cocktail/show.html.twig', [
                'cocktail' => $cocktail
        ]);
    }

    /**
     * @Route("/ingredients", name="ingredients")
     */
    public function ingredients(IngredientRepository $repo)
    {
        $ingredients = $repo->findAll();

        return $this->render('cocktail/ingredients.html.twig', [
            'controller_name' => 'CocktailController',
            'ingredients' => $ingredients
        ]);
    }

    /**
    * @Route("/create", name = "create")
     * @Route("/cocktail/{id}/edit", name = "edit")
     */

    public function create(Cocktail $cocktail = null, Request $request, EntityManagerInterface $manager){
        //si il n'y a pas de cocktail j'en crée un
        if(!$cocktail){
            $cocktail = new Cocktail();
        }

        $form = $this->createForm(CocktailType::class, $cocktail);

        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($cocktail);
            $manager->flush();

            return $this->redirectToRoute('cocktail_show', ['id' =>$cocktail->getId()]);

        }


        return $this->render('cocktail/create.html.twig', [
            'formCocktail' => $form->createView(),
            // difference entre edit et create au niveau du bouton
            'editMode' => $cocktail->getId() !== null
        ]);
    }


}
