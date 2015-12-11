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
		$userSkill = array(
			array('user' => 2, 'skill' => 4),
			array('user' => 10, 'skill' =>6),
			array('user' => 6, 'skill' => 8),
			array('user' => 10, 'skill' => 3),
			array('user' => 5, 'skill' => 12),
			array('user' => 4, 'skill' => 15),
			array('user' => 8, 'skill' => 17),
			array('user' => 6, 'skill' => 5),
			array('user' => 9, 'skill' => 7),
			array('user' => 11, 'skill' => 1),
			array('user' => 13, 'skill' => 2),
			array('user' => 12, 'skill' => 20),
			array('user' => 17, 'skill' => 8),
			);

		foreach ($userSkill as $us) {
			$repository = $manager
	        ->getRepository('AppBundle:User');
	        $userEntity = $repository->find($us['user']);
			
			$repository = $manager
	        ->getRepository('AppBundle:Skill');
	        $skillEntity = $repository->find($us['skill']);
	        
	        $userSkillEntity = new UserSkill();
	        $userSkillEntity->setUser($userEntity);
	        $userSkillEntity->setSkill($skillEntity);
	        $userSkillEntity->setIsActive(1);

        	$manager->persist($userSkillEntity);
        }
        
        $manager->flush();

	}
}