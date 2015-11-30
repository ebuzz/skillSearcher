<?php 
// src/AppBundle/Repository/UserTeamRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserTeamRepository extends EntityRepository
{
	public function findByUserSelected($id)
	{
		$em = $this->getEntityManager();
		$qb = $em->createQueryBuilder('ut')
			->select('ut.userTeamId, t.teamId, u.name, u.lastName, u.surName')
			->from('AppBundle:UserTeam', 'ut')
			->leftJoin('ut.user', 'u')
			->leftJoin('ut.team', 't')
			->where('ut.team = :id')
		    ->setParameter('id', $id)
		    ->getQuery();
		return $qb->getResult();
	}
}