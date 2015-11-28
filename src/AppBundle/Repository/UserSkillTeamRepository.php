<?php 
// src/AppBundle/Repository/UserSkillTeamRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserSkillTeamRepository extends EntityRepository
{
	public function findBySkillSelected($id)
	{
		$qb =  $this->getEntityManager()->createQueryBuilder();
		$qb -> select('us')
		    -> from('AppBundle:UserSkillTeam', 'us')
		    -> innerJoin('us.userteam', 'ut')
		    -> innerJoin('us.userskill', 's')
		    -> where('ut.team = :id')
		    -> setParameter('id', $id)
		    -> getQuery()
		    -> getResult();
		
		return $qb;
	}
}