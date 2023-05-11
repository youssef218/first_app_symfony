<?php

namespace App\Controller;


use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/ingredient/nouveau', name: 'new_ingredient', methods:['GET' , 'POST'])]
    public function new(
        Request $request ,
        EntityManagerInterface $manager,
        ) :Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient) ;

         $form->handleRequest($request);
        // $form->submit($request->request->get($form->getName()));
        if ($form->isSubmitted() && $form->isValid()) {
            $ingredient = $form->getData();
            $manager->persist($ingredient);
            $manager->flush();
            
        }
        

        return $this->render('pages/ingredient/new.html.twig' , [
            'form' => $form->createView()
        ]);
    }

    
}
