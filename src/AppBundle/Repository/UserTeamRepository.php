<?php 
// src/AppBundle/Repository/UserTeamRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserTeamRepository extends EntityRepository
{
	public function findBySkillSelected($id)
	{
		$qb =  $this->getEntityManager()->createQueryBuilder();
		$qb -> select('ut.userTeamId, s.name')
		    -> from('AppBundle:UserTeam', 'ut')
		    -> innerJoin('ut.userSkillTeamId', 'us') 
		    -> innerJoin('us.userSkillId', 's')
		    -> where('ut.teamId = :id')
		    -> setParameter('id', $id)
		    -> getQuery();
		
		$userSkill = $qb->getResult();
		return $userSkill;
	}

	public function findByUserSelected($id)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb -> select('ut.userTeamId, u.name, u.lastName, u.surName')
			-> from('AppBundle:UserTeam', 'ut')
			-> innerJoin('ut.userId', 'u')
			-> where('ut.teamId = :id')
		    -> setParameter('id', $id)
		    -> getQuery();
		$userName = $qb->getResult();
		return $userName;
	}