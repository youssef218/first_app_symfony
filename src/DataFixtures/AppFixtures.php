<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredient;
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
        for( $i = 1 ; $i<=50 ; $i++ ){
            $ingredient = new Ingredient();
            $ingredient->setNom($this->faker->word())
                       ->setPrix(mt_rand(0,100)) ;
            $manager->persist($ingredient);
        }
        // $ingredient = new Ingredient();
        // $ingredient->setNom('Chocolate')
        //            ->setPrix(3.0) ;
        // $product = new Product();
        // $manager->persist($product);
        $manager->persist($ingredient);
        $manager->flush();
    }
}
