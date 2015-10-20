<?php 

// src/AppBundle/DataFixtures/ORM/Positions.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Position;

class Positions extends AbstractFixture implements OrderedFixtureInterface
{

	public function getOrder()
	{
		return 2;
	}

	public function load(ObjectManager $manager)
	{
		$positions = array(
			array('name' => 'Software Developer Sr'),
			array('name' => 'Software Developer Mid'),
			array('name' => 'Software Developer Jr'),
			array('name' => 'UX Designer Sr'),
			array('name' => 'UX Designer Mid'),
			array('name' => 'UX Designer Jr'),
			array('name' => 'UI Designer Sr'),
			array('name' => 'UI Designer Mid'),
			array('name' => 'UI Designer Jr'),
			array('name' => 'Contador'),
			array('name' => 'RH'),
			array('name' => 'Backend Developer Sr'),
			array('name' => 'Backend Developer Mid'),
			array('name' => 'Backend Developer Jr'),
			array('name' => 'Frontend Developer Sr'),
			array('name' => 'Frontend Developer Mid'),
			array('name' => 'Frontend Developer Jr'),
		);

		foreach ($positions as $role) 
		{
			$entity = new Position();
			$entity->setName($role['name']);
			
			$manager->persist($entity);

		}

		$manager->flush();
	}
}