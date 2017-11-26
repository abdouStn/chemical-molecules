<?php

namespace ChemicalsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional tests, used to greatly improve code coverage.
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Molecules representation system', $client->getResponse()->getContent());
    }

    public function testListing()
    {
        $client = static::createClient();

        $client->request('GET', '/chemicals/elements/list');
        $this->assertContains('Number of elements in database', $client->getResponse()->getContent());

        $client->request('GET', '/chemicals/atoms/list');
        $this->assertContains('Number of atoms in database', $client->getResponse()->getContent());
        
        $client->request('GET', '/chemicals/molecules/list');
        $this->assertContains('Number of molecules in database', $client->getResponse()->getContent());
    }
}
