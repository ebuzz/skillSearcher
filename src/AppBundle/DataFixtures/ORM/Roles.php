<?php 

// src/AppBundle/DataFixtures/ORM/Roles.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Role;

class Roles extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 1;
	}

	public function load(ObjectManager $manager)
	{
		$roles = array(
			array('name' => 'Colaborador'),
			array('name' => 'Administrador'),
			array('name' => 'RH'),
		);

		foreach ($roles as $role) 
		{
			$entity = new Role();
			$entity->setName($role['name']);
			
			$manager->persist($entity);

		}

		$manager->flush();
	}
}