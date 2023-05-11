<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    
    #[Route('/ingredient', name: 'app_ingredient', methods:['GET'])]
    public function index(IngredientRepository $Repository , PaginatorInterface $paginator , Request $request): Response
    {
        
        /** 
         *  function afficher all ingredient 
         * @param IngredientRepository $repository
         *  @param PaginatorInterface $paginator
         *  @param Request $request
         *   @return Response
         */
        $ingredients = $paginator->paginate(
            $Repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        // dd($ingredients);
        return $this->render('pages/ingredient/index.html.twig' , [
            'ingredients' => $ingredients ,
            'pagination' => $ingredients
        ]);
    }
}
