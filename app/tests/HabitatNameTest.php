<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class HabitatNameTest extends WebTestCase
{

    protected static function getKernelClass(): string
    {
        return \App\Kernel::class;
    }

    public function testMain(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'ZOO');
    }

        public function TeshHabitatPage(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/habitats');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $habitatNames = ['Montagnes', 'Savane', 'Fôret', 'Desert'];
        $habitatCards = $crawler->filter('.habitat-name');
        $this->assertCount(count($habitatNames), $habitatCards);

        $extractedNames = [];
        foreach ($habitatCards as $card) {
            $extractedNames[] = trim($card->nodeValue);
        }

        sort($habitatNames);
        sort($extractedNames);

        $this->assertEquals($habitatNames, $extractedNames);
    }

    public function testHabitatSavane()
    {
        $client = static::createClient();

        // On suppose que l'URL de la liste des habitats est /habitats
        $crawler = $client->request('GET', '/habitats');

        // On clique sur le lien vers la page de l'habitat "Savane"
        $link = $crawler->filter('.habitat-card:contains("Savane")')->link();
        $crawler = $client->click($link);

        // On vérifie que le titre de la page est bien "Habitat : Savane"
        $this->assertEquals('Habitat : Savane', $crawler->filter('.habitat-title')->text());

        // On vérifie que l'image de l'habitat est bien affichée
        $this->assertNotEmpty($crawler->filter('.habitat-image')->attr('src'));

        // On vérifie que la description de l'habitat est bien affichée
        $this->assertNotEmpty($crawler->filter('.habitat-description')->text());
    }

    public function testClickHabitat()
     {
        $client = static::createClient();

        // On suppose que l'URL de la liste des habitats est /habitats
        $crawler = $client->request('GET', '/habitats');

        $habitatNames = ['Montagnes', 'Savane', 'Forêt', 'Désert'];

        $habitatCards = $crawler->filter('.habitat-card');

        $extractedNames = [];
        foreach ($habitatCards as $card) {
            $extractedNames[] = trim($card->nodeValue);
        }

        sort($habitatNames);
        sort($extractedNames);

        $this->assertEquals($habitatNames, $extractedNames);

        foreach ($habitatNames as $name) {
            // On clique sur le lien vers la page de l'habitat
            $crawler = $client->request('GET', '/habitats');
            $link = $crawler->filter('.habitat-card:contains("' . $name . '")')->link();
            $crawler = $client->click($link);

            // On vérifie que le titre de la page est bien "Habitat : $name"
            $this->assertEquals('Habitat : ' . $name, $crawler->filter('.habitat-title')->text());
        }
    }



}
