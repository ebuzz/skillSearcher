<?php 
// src/AppBundle/Repository/VoteRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class VoteRepository extends EntityRepository
{
    public function counting($userSkill)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('COUNT(v.userkill) as rate')
            ->from('AppBundle:Vote', 'v')
            ->where('v.userkill = :id')
            ->setParameter('id', $userSkill)
            ->getQuery();
        return $qb->getResult();
    }
}