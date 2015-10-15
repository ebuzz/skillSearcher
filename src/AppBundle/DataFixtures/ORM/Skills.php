<?php 

// src/AppBundle/DataFixtures/ORM/Skill.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Skill;

class Skills implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$skills = array(
			array('name' => 'C#'),
			array('name' => 'Entity Framework'),
			array('name' => 'Java'),
			array('name' => 'Go'),
			array('name' => 'Dart'),

		);

		foreach ($skills as $skill) 
		{
			$entity = new Skill();
			$entity->setName($skill['name']);
			
			$manager->persist($entity);

		}

		$manager->flush();
	}
}