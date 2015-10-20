<?php 

// src/AppBundle/DataFixtures/ORM/Teams.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Team;

class Teams extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 4;
	}

	public function load(ObjectManager $manager)
	{
		$teams = array(
			array('name' => 'Equipo Temporal 1'),
			array('name' => 'Equipo de nuevos'),
			array('name' => 'Ayudantes para web'),
		);

		foreach ($teams as $team) 
		{
			$entity = new Team();
			$entity->setName($team['name']);
			$manager->persist($entity);

		}

		$manager->flush();
	}
}