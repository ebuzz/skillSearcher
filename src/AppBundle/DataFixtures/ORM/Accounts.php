<?php 

// src/AppBundle/DataFixtures/ORM/Account.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Account;

class Accounts extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 3;
	}
	
	public function load(ObjectManager $manager)
	{
		$accounts = array(
			array('name' => 'Playboy', 'leaderName' => 'Patricio Estrella', 'technologyDescription' => '.NET'),
			array('name' => 'Nintendo', 'leaderName' => 'Bob Esponja', 'technologyDescription' => 'GNU/Linux'),
			array('name' => 'Sony', 'leaderName' => 'Don Cangrejo', 'technologyDescription' => '.NET'),
		);

		foreach ($accounts as $account) 
		{
			$entity = new Account();
			$entity->setName($account['name']);
			$entity->setLeaderName($account['leaderName']);
			$entity->setTechnologyDescription($account['technologyDescription']);
			
			$manager->persist($entity);

		}

		$manager->flush();
	}
}