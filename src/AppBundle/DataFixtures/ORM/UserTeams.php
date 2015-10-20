<?php 

// src/AppBundle/DataFixtures/ORM/UserTeams.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\UserTeam;

class UserTeams extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 8;
	}
	
	public function load(ObjectManager $manager)
	{
		// Role : Colaborador
		$repository = $manager
        ->getRepository('AppBundle:User');
        $userEntity = $repository->find(1);

        // Team : Equipo Temporal 1
		$repository = $manager
        ->getRepository('AppBundle:Team');
        $teamEntity = $repository->find(1);
        
        $userTeamEntity = new UserTeam();
        $userTeamEntity->setUser($userEntity);
        $userTeamEntity->setTeam($teamEntity);

        $manager->persist($userTeamEntity);
        $manager->flush();

	}
}