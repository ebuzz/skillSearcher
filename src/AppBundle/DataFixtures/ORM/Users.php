<?php 

// src/AppBundle/DataFixtures/ORM/Users.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Position;
use AppBundle\Entity\Role;

class Users extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 5;
	}

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
		
		// Cuando se haga el 'seed' de Usuarios se pondran Roles por default

		// Role : Colaborador
		$repository = $manager
        ->getRepository('AppBundle:Role');
        $roleEntity = $repository->find(1);

        // Position : Software Developer
		$repository = $manager
        ->getRepository('AppBundle:Position');
        $positionEntity = $repository->find(1);

        // dump($roleentity);

        // $roleentity = new Role();
        // $roleentity->setName("ROL NO REAL");

        // $positionentity = new Position();
        // $positionentity->setName("POSICION NO REAL");

		foreach ($users as $user) 
		{
			$entity = new User();
			$entity->setName($user['name']);
			$entity->setLastName($user['lastName']);
			$entity->setSurName($user['surName']);
			$entity->setEmail($user['email']);
			$entity->setPassword($user['password']);
			$entity->setAdmissionDate(new \DateTime("now"));
			$entity->setImage('imagen.jotapege');
			$entity->setRol($roleEntity);
			$entity->setPosition($positionEntity);
			$manager->persist($entity);

		}

		$manager->flush();
	}
}