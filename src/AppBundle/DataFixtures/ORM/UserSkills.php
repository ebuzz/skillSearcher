<?php 

// src/AppBundle/DataFixtures/ORM/UserSkills.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\UserSkill;

class UserSkills extends AbstractFixture implements OrderedFixtureInterface
{
	public function getOrder()
	{
		return 7;
	}
	
	public function load(ObjectManager $manager)
	{
		// Role : Colaborador
		$repository = $manager
        ->getRepository('AppBundle:User');
        $userEntity = $repository->find(1);

        // Position : Software Developer
		$repository = $manager
        ->getRepository('AppBundle:Skill');
        $skillEntity = $repository->find(1);
        
        $userSkillEntity = new UserSkill();
        $userSkillEntity->setUser($userEntity);
        $userSkillEntity->setSkill($skillEntity);

        $manager->persist($userSkillEntity);
        $manager->flush();

	}
}