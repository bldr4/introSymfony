<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Posts;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class PostsFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 200; $i++) {
            $post = new Posts();
            $post
            ->setTitle($faker->words(3, true))
            ->setContent($faker->paragraphs(3, true))
            ->setState(mt_rand(0,2) === 1 ? Posts::STATES[0]: Posts::STATES[1]);

            $manager->persist($post);
        }

        $manager->flush();
    }
}
