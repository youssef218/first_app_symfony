<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Recipe;
use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker ;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {
        # ingredient
        $ingredient = [];
        for( $i = 1 ; $i<=50 ; $i++ ){
            $ingredient = new Ingredient();
            $ingredient->setNom($this->faker->word())
                       ->setPrix(mt_rand(0,100)) ;
            $ingredients[] = $ingredient ;
            $manager->persist($ingredient);
        }
        # recepe
        $recepe = [];
        for( $i = 1 ; $i<=30 ; $i++ ){
            $recipe = new Recipe();
            $recipe->setName($this->faker->word())
                ->setTime(mt_rand(0, 1) == 1 ? mt_rand(1, 1446) : null)
                ->setNbPeople(mt_rand(0, 1) == 1 ? mt_rand(1, 50) : null)
                ->setDifficulty(mt_rand(0, 1) == 1 ? mt_rand(1, 5) : null)
                ->setDescription($this->faker->text(300))
                ->setPrice(mt_rand(0, 1) == 1 ? mt_rand(1, 1000) : null)
                ->setIsFavorite(mt_rand(0, 1) == 1 ? true : false);
            for($k =0 ; $k <= mt_rand(5 , 15) ; $k++){
                $recipe->addIngredient($ingredients[mt_rand(0, count($ingredients)-1)]);
            }
            $manager->persist($recipe);
        }        

        $manager->flush();
    }
}
   // $ingredient = new Ingredient();
        // $ingredient->setNom('Chocolate')
        //            ->setPrix(3.0) ;
        // $product = new Product();
        // $manager->persist($product);
        // $manager->persist($ingredient);