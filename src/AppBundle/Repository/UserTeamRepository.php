<?php 
// src/AppBundle/Repository/UserTeamRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserTeamRepository extends EntityRepository
{
	public function findByUserSelected($id)
	{
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb -> select('ut')
			-> from('AppBundle:UserTeam', 'ut')
			-> innerJoin('ut.user', 'u')
			-> where('ut.team = :id')
		    -> setParameter('id', $id)
		    -> getQuery()
			-> getResult();

		return $qb;
	}
}