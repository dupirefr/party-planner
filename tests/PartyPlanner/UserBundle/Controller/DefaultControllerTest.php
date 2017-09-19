<?php

namespace PartyPlanner\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
	/*
	 * Tests
	 */
	/**
	 * @param string $url the route url
	 *
	 * @dataProvider urlProvider
	 */
    public function testUrls($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

		$this->assertTrue($client->getResponse()->isSuccessful());
    }

    /*
     * Methods
     */
    public function urlProvider()
    {
    	return array(
    		array('/signup')
	    );
    }
}
