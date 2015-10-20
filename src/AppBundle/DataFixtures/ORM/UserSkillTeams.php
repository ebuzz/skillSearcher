<?php 

// src/AppBundle/DataFixtures/ORM/UserSkillTeams.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\UserSkillTeam;

class UserSkillTeams extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 9;
	}
	
	public function load(ObjectManager $manager)
	{
		// UserSkill : 1
		$repository = $manager
        ->getRepository('AppBundle:UserSkill');
        $userSkillEntity = $repository->find(1);

        // UserTeam : 1
		$repository = $manager
        ->getRepository('AppBundle:UserTeam');
        $userTeamEntity = $repository->find(1);
        
        $userSkillTeamEntity = new UserSkillTeam();
        $userSkillTeamEntity->setUserSkill($userSkillEntity);
        $userSkillTeamEntity->setUserTeam($userTeamEntity);

        $manager->persist($userSkillTeamEntity);
        $manager->flush();

	}
}