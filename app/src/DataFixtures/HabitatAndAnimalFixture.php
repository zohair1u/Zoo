<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Habitat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HabitatAndAnimalFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $habitatAnimals = [
            'Forêt' => [
                'description' => "La forêt est un milieu luxuriant riche en biodiversité, avec des arbres géants, des feuillages denses et un climat humide. Les animaux tels que les cerfs, les sangliers, les renards et les chouettes y trouvent abri et nourriture. Notre forêt recréée offre une immersion naturelle propice à leur bien-être.",
                'image' => 'foret.jpg',
                'animaux' => [
                    ['prenom' => 'Bambi', 'race' => 'Cerf', 'image' => 'cerf.jpg'],
                    ['prenom' => 'Grizzly', 'race' => 'Sanglier', 'image' => 'sanglier.jpg'],
                    ['prenom' => 'Rox', 'race' => 'Renard', 'image' => 'renard.jpg'],
                    ['prenom' => 'Hedwig', 'race' => 'Chouette', 'image' => 'chouette.jpg'],
                    ['prenom' => 'Ghost', 'race' => 'Loup', 'image' => 'loup.jpg'],
                ],
            ],
            'Désert' => [
                'description' => "Le désert est un environnement aride et sablonneux où les températures extrêmes mettent à l’épreuve ses habitants. Les fennecs, dromadaires, serpents et lézards ont adapté leur mode de vie pour survivre dans ce milieu. Dans notre zoo, le désert recréé assure chaleur, espace et sérénité.",
                'image' => 'desert.jpg',
                'animaux' => [
                    ['prenom' => 'Sandy', 'race' => 'Fennec', 'image' => 'fennec.jpg'],
                    ['prenom' => 'Caravane', 'race' => 'Dromadaire', 'image' => 'dromadaire.jpg'],
                    ['prenom' => 'Venom', 'race' => 'Serpent', 'image' => 'serpent.jpg'],
                    ['prenom' => 'Spike', 'race' => 'Scorpion', 'image' => 'scorpion.jpg'],
                    ['prenom' => 'Dash', 'race' => 'Lézard', 'image' => 'lezard.jpg'],
                ],
            ],
            'Montagnes' => [
                'description' => "Les montagnes offrent des sommets majestueux et des terrains escarpés. Les animaux comme les chamois, marmottes, lynx et aigles y vivent dans un environnement rude mais grandiose. Notre espace montagneux assure des falaises et des hauteurs pour reproduire ce cadre naturel.",
                'image' => 'montagnes.jpg',
                'animaux' => [
                    ['prenom' => 'Alta', 'race' => 'Chamois', 'image' => 'chamois.jpg'],
                    ['prenom' => 'Fluffy', 'race' => 'Marmotte', 'image' => 'marmotte.jpg'],
                    ['prenom' => 'Shadow', 'race' => 'Lynx', 'image' => 'lynx.jpg'],
                    ['prenom' => 'Sky', 'race' => 'Aigle', 'image' => 'aigle.jpg'],
                    ['prenom' => 'Rocky', 'race' => 'Bouquetin', 'image' => 'bouquetin.jpg'],
                ],
            ],
            'Savane' => [
                'description' => "La savane est un écosystème fascinant qui se caractérise par de vastes étendues de prairies et de plaines herbeuses parsemées d'arbres et de buissons. C'est un milieu naturel qui abrite une incroyable diversité d'espèces animales et végétales, adaptées à des conditions climatiques souvent extrêmes...",
                'image' => 'savane.jpg',
                'animaux' => [
                    ['prenom' => 'Simba', 'race' => 'Lion', 'image' => 'lion.jpg'],
                    ['prenom' => 'Zuri', 'race' => 'Girafe', 'image' => 'girafe.jpg'],
                    ['prenom' => 'Nyala', 'race' => 'Antilope', 'image' => 'antilope.jpg'],
                    ['prenom' => 'Stripes', 'race' => 'Zèbre', 'image' => 'zebre.jpg'],
                    ['prenom' => 'Flash', 'race' => 'Guépard', 'image' => 'guepard.jpg'],
                ],
            ],
        ];

        foreach ($habitatAnimals as $nom => $data) {
            $habitat = new Habitat();
            $habitat->setNom($nom);
            $habitat->setImage($data['image']);
            $habitat->setDescription($data['description']);
            $habitat->setCreatedAt(new \DateTime());

            $manager->persist($habitat);

            foreach ($data['animaux'] as $info) {
                $animal = new Animal();
                $animal->setPrenom($info['prenom']);
                $animal->setRace($info['race']);
                $animal->setEtat('En bonne santé');
                $animal->setImage($info['image']);
                $animal->setCreatedAt(new \DateTime());
                $animal->setHabitat($habitat);

                $manager->persist($animal);
}
}

        $manager->flush();
}
}