<?php

namespace App\Controller;

use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecipeController extends AbstractController
{
    /**
     * afficher tout les recette
     *
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param RecipeRepository $Repository
     * @return Response
     */
    #[Route('/recette', name: 'recette.index' , methods:['GET'])]
    public function index(
        PaginatorInterface $paginator ,
        Request $request ,
        RecipeRepository $Repository ,
    ): Response
    {
        $recipes = $paginator->paginate(
            $Repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('pages/recipe/index.html.twig',[
            'recipe' => $recipes,
            'recipes' => $recipes
        ]);
    }
    
    
}
