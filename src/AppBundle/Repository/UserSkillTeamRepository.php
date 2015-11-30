<?php 
// src/AppBundle/Repository/UserSkillTeamRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserSkillTeamRepository extends EntityRepository
{
	public function findBySkillSelected($id)
	{
		$em = $this->getEntityManager();
		$qb	= $em->createQueryBuilder('ust')
			->select('ut.userTeamId, s.name')
		    ->from('AppBundle:UserSkillTeam', 'ust')
		    ->leftJoin('ust.userteam', 'ut')
		    ->leftJoin('ust.userskill', 'us')
		    ->leftJoin('us.skill', 's')
		    ->where('ut.team = :id')
		    ->setParameter('id', $id)
		    ->getQuery();
		return $qb->getResult();
	}
}