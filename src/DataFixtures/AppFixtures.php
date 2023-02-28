<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Entity\Salon;
use App\Entity\Tatoueurs;
use App\Entity\Flash;
use App\Entity\Media;
use App\Entity\Color;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        
        for ($i = 0; $i < 10; $i++) {
            $salons = new Salon();
            $salons->setName('salon '.$i);
            $salons->setAdress('salon '.$i);
            $salons->setDescription('Duis bibendum lacus velit. Quisque dapibus ultricies malesuada. Sed dignissim condimentum mauris at mattis. Morbi malesuada elementum tincidunt. Donec nulla metus, cursus eget massa non, tempus maximus elit. Pellentesque blandit magna vel nibh sollicitudin, vitae imperdiet orci vehicula. Nullam tristique nunc ac condimentum fermentum.'.$i);
            // $salons->setCreatedAt(new \DateTimeImmutable());
            // $salons->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($salons);
        }

        for ($i = 0; $i < 40; $i++) {
            $tatoueurs = new Tatoueurs();
            $tatoueurs->setfirstName($faker->firstName());
            $tatoueurs->setlastName($faker->lastName());
            $tatoueurs->setDescription('Duis bibendum lacus velit. Agna vel nibh sollicitudin, vitae imperdiet orci vehicula. Nullam tristique nunc ac condimentum fermentum.'.$i);
            $tatoueurs->setInstagram('https://www.instagram.com/pierre_caillet/?hl=fr ');
            $tatoueurs->setEmail('pierre.caillet@edu.devinci.fr');
            $tatoueurs->setImageUrl('https://images.pexels.com/photos/6652928/pexels-photo-6652928.jpeg?auto=compress&cs=tinysrgb&w=1600');
            $tatoueurs->setSalonId($salons);
            // $tatoueurs->setCreatedAt(new \DateTimeImmutable());
            // $tatoueurs->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($tatoueurs);
        }

        for ($i = 0; $i < 80; $i++) {
            $flashs = new Flash();
            $flashs->setPrice(mt_rand(50, 1000));
            $flashs->setSize(mt_rand(3, 29));
            $flashs->setDescription('Un nouveau flash est disponible, n\'hésitez pas à le consulter !');
            $flashs->setTatoueur($tatoueurs);
            // $flashs->setCreatedAt(new \DateTimeImmutable());
            // $flashs->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($flashs);
        }

        for ($i = 0; $i < 100; $i++) {
            $media = new Media();
            $media->setFileName('feqhfpesjfozje');
            $media->setSalonId($salons);
            $media->setFlash($flashs);

            $manager->persist($media);
        }

        for ($i = 0; $i < 10; $i++) {
            $color = new Color();
            // $color->setName('color '.$i);
            // $color->setCreatedAt(new \DateTimeImmutable());
            // $color->setUpdatedAt(new \DateTimeImmutable());

            $manager->persist($color);
        }

        $manager->flush();
    }
}
