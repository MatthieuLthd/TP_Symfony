<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker=Factory::create("fr_FR");

        $categorie=new Categorie();
        $categorie->setLibelle("Professionnel")
                    ->setDescription($faker->sentence(50))
                    ->setImage("images/categories/professionnel.jpg");
        $manager->persist($categorie);

        $categorie=new Categorie();
        $categorie->setLibelle("Sport")
                    ->setDescription($faker->sentence(50))
                    ->setImage("images/categories/sport.jpg");
        $manager->persist($categorie);
        
        $categorie=new Categorie();
        $categorie->setLibelle("Privé")
                    ->setDescription($faker->sentence(50))
                    ->setImage("images/categories/prive.jpg");
        $manager->persist($categorie);

        $genres=["male","female"];

        for ($i=0; $i < 100; $i++) {
            
            $sexe=mt_rand(0,1);
            if ($sexe==0) {
                $type="men";
            }else{
                $type="women";
            }

            $contact=new Contact();
            $contact->setNom($faker->lastName())
                    ->setPrenom($faker->firstName($genres[mt_rand(0,1)]))
                    ->setRue($faker->streetAddress())
                    ->setCp($faker->numberBetween(75000,92000))
                    ->setVille($faker->city())
                    ->setMail($faker->email())
                    ->setSexe($sexe)
                    ->setAvatar("https://randomuser.me/api/portraits/". $type."/".$i.".jpg");
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
