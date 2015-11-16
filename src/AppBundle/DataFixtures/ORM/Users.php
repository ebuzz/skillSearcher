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
		array('name' => 'Administrador', 'lastName' => 'Site', 'surName' => ' ', 'email' => 'admin@arkusnexus.com', 'password' => 'admin', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_ADMIN', 'positionId' => 1 ),
		array('name' => 'Alejandro', 'lastName' => 'Hernandez', 'surName' => 'Marquez', 'email' => 'user1@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Bernardo', 'lastName' => 'Lemus', 'surName' => 'Ortiz', 'email' => 'user2@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Christian', 'lastName' => 'Flores', 'surName' => 'Filis', 'email' => 'user3@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'David', 'lastName' => 'Acosta', 'surName' => 'Arellano', 'email' => 'user4@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Eric', 'lastName' => 'Martinez', 'surName' => 'Ibarra', 'email' => 'user5@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Felipe', 'lastName' => 'Trejo', 'surName' => 'Contreras', 'email' => 'user6@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Gerardo', 'lastName' => 'Garcia', 'surName' => 'Najera', 'email' => 'user7@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Hugo', 'lastName' => 'Ruiz', 'surName' => 'Sanchez', 'email' => 'user8@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Ignacio', 'lastName' => 'Corona', 'surName' => 'Silva', 'email' => 'user9@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Javier', 'lastName' => 'Reyes', 'surName' => 'Leon', 'email' => 'user10@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Karla', 'lastName' => 'Juarez', 'surName' => 'Mejia', 'email' => 'user11@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Lorenzo', 'lastName' => 'Escoto', 'surName' => 'Villalobos', 'email' => 'user12@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Manuel', 'lastName' => 'Rivas', 'surName' => 'Quiroz', 'email' => 'user13@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Nestor', 'lastName' => 'Salinas', 'surName' => 'Morales', 'email' => 'user14@arkusnexus.com', 'password' => 'admin', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Omar', 'lastName' => 'Torres', 'surName' => 'Zavaleta', 'email' => 'user15@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Pedro', 'lastName' => 'Romero', 'surName' => 'Flores', 'email' => 'user16@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Ruben', 'lastName' => 'Aceves', 'surName' => 'Nieto', 'email' => 'user17@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Santiago', 'lastName' => 'Soriano', 'surName' => 'Aguilar', 'email' => 'user18@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Teodoro', 'lastName' => 'Martinez', 'surName' => 'Navarrete', 'email' => 'user19@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Unai', 'lastName' => 'Santos', 'surName' => 'Villareal', 'email' => 'user20@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Victor', 'lastName' => 'Gomez', 'surName' => 'Alba', 'email' => 'user21@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Xabier', 'lastName' => 'Mascorro', 'surName' => 'Tejeda', 'email' => 'user22@arkusnexus.com', 'password' => '1234', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		array('name' => 'Yeray', 'lastName' => 'Aviles', 'surName' => 'Ochoa', 'email' => 'user23@arkusnexus.com', 'password' => 'admin', 'admissionDate' => '12-12-12', 'roles' => 'ROLE_USER', 'positionId' => 1 ),
		// ...
		);
		
		// Cuando se haga el 'seed' de Usuarios se pondran Roles por default

		// Role : Colaborador
		// $repository = $manager
  		// ->getRepository('AppBundle:Role');
  		// $roleEntity = $repository->find(1);

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
			$entity->setUsername($user['email']);
			$entity->setPassword($user['password']);
			$entity->setAdmissionDate(new \DateTime("now"));
			$entity->setImage('imagen.jotapege');
			$entity->setRoles($user['roles']);
			$entity->setPosition($positionEntity);
			$manager->persist($entity);
		}

		$manager->flush();
	}
}