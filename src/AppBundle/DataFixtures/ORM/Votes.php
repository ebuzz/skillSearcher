<?php 

// src/AppBundle/DataFixtures/ORM/Votes.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Vote;

class Votes extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 10;
	}
	
	public function load(ObjectManager $manager)
	{
		// UserSkill : 1
		$repository = $manager
        ->getRepository('AppBundle:UserSkill');
        $userSkillEntity = $repository->find(1);

        // User : 2
		$repository = $manager
        ->getRepository('AppBundle:User');
        $userEntity = $repository->find(2);
        
        $voteEntity = new Vote();
        $voteEntity->setUserSkill($userSkillEntity);
        $voteEntity->setUser($userEntity);

        $manager->persist($voteEntity);
        $manager->flush();

	}
}