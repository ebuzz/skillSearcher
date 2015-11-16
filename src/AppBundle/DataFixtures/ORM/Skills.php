<?php 

// src/AppBundle/DataFixtures/ORM/Skills.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Skill;

class Skills extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 6;
	}

	public function load(ObjectManager $manager)
	{
		$skills = array(
			array('name' => 'C#'),
			array('name' => 'C'),
			array('name' => 'C++'),
			array('name' => 'Objective-C'),
			array('name' => 'PHP'),
			array('name' => 'Python'),
			array('name' => 'Ruby'),
			array('name' => 'JavaScript'),
			array('name' => 'SQL'),
			array('name' => 'Assembly Language'),
			array('name' => 'Swift'),
			array('name' => 'Prototyping'),
			array('name' => 'Angular JS'),
			array('name' => 'Bootstrap'),
			array('name' => 'MATLAB'),
			array('name' => 'XML'),
			array('name' => 'Perl'),
			array('name' => 'AWS'),
			array('name' => 'WPF'),
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