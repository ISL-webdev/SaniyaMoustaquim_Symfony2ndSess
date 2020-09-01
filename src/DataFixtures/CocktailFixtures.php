<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CocktailFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        //generer des données dans la db et imbriquer les boucles

        //remplissage categories
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category();

            $category->setName($faker->sentence())
                ->setDescription($faker->sentence());

            $manager->persist($category);

            //remplissage cocktails
            for ($j = 1; $j <= 5; $j++) {
                $cocktail = new Cocktail();

                $random = random_int(1, 10);

                $cocktail->setName($faker->sentence())
                    ->setDescription($faker->sentence())
                    ->setImage($faker->imageUrl())
                    ->setPrice($random)
                    ->setVolume($random)
                    ->setOrigin($faker->country())
                    ->setCategory($category);

                $manager->persist($cocktail);

                //remplissage ingredients
                for ($k = 1; $k <= 5; $k++) {
                    $ingredient = new Ingredient();

                    $ingredient->setName($faker->sentence())
                               ->setDescription($faker->sentence());

                    $manager->persist($ingredient);
                }

            }

        }



        $manager->flush();

    }
}
