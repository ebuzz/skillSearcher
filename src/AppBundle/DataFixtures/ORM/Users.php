<?php 

// src/AppBundle/DataFixtures/ORM/Users.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;

class Users implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$users = array(
		array('name' => 'Juan', 'lastName' => 'Aguayo', 'surName' => 'Sanchez', 'email' => 'jvalenzuela@arkusnexus.com', 'password' => '1234', 'position' => 'Sr Software Developer', 'admissionDate' => '12-12-12', 'roleId' => 1, 'positionId' => 1 ),
		array('name' => 'Mariana', 'lastName' => 'Valenzuela', 'surName' => 'Marquez', 'email' => 'jvalenzuela@arkusnexus.com', 'password' => '1234', 'position' => 'Sr Software Developer', 'admissionDate' => '12-12-12', 'roleId' => 1, 'positionId' => 1 ),
		array('name' => 'Alberto', 'lastName' => 'Gonzalez', 'surName' => 'Lara', 'email' => 'jvalenzuela@arkusnexus.com', 'password' => '1234', 'position' => 'Sr Software Developer', 'admissionDate' => '12-12-12', 'roleId' => 1, 'positionId' => 1 ),
		array('name' => 'Araceli', 'lastName' => 'Martinez', 'surName' => 'Rojas', 'email' => 'jvalenzuela@arkusnexus.com', 'password' => '1234', 'position' => 'Sr Software Developer', 'admissionDate' => '12-12-12', 'roleId' => 1, 'positionId' => 1 ),
		array('name' => 'Cristina', 'lastName' => 'Lara', 'surName' => 'Sanchez', 'email' => 'jvalenzuela@arkusnexus.com', 'password' => '1234', 'position' => 'Sr Software Developer', 'admissionDate' => '12-12-12', 'roleId' => 1, 'positionId' => 1 ),
		// ...
		);
		foreach ($users as $user) 
		{
			$entity = new User();
			$entity->setName($user['name']);
			$entity->setLastName($user['lastName']);
			$entity->setSurName($user['surName']);
			$entity->setEmail($user['email']);
			$entity->setPassword($user['password']);
			// $entity->setPosition($user['position']);
			$entity->setAdmissionDate(new \DateTime("now"));
			$entity->setImage('imagen.jotapege');
			// We need to find a way to insert the Object itself with some Id, maybe a query?

			// $role = $manager
   //      	->getRepository('AppBundle:Role')
   //      	->find(1);

			// $entity->setRole($role);

			// $manager->persist($role);
			$manager->persist($entity);

		}

		$manager->flush();
	}
}