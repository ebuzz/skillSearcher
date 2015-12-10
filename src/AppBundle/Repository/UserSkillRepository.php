<?php 
// src/AppBundle/Repository/UserSkillRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserSkillRepository extends EntityRepository
{
    public function findIdToManage($userId, $skillId)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('us')
            ->from('AppBundle:UserSkill', 'us')
            ->where('us.skill = ' . $skillId)
            ->andWhere('us.user = ' . $userId)
            ->getQuery();
        return $qb->getResult();
    }
}