<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientRepository;
class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $Repository): Response
    {
        // dd($ingredients);
        return $this->render('pages/ingredient/index.html.twig' , [
            'ingredients' => $Repository->findAll()
        ]);
    }
}
