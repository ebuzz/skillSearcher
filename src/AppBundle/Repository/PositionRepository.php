<?php
// src/AppBundle/Repository/PositionRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PositionRepository extends EntityRepository
{
    public function searchPosition($name)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('u')
            ->addSelect('COUNT(v.user) as hidden rate')
            ->from('AppBundle:User', 'u')
            ->innerJoin('u.position', 'p')
            ->where('p.name LIKE :name')
            ->leftJoin('u.skills', 'us', 'WITH', 'us.user = u.userId')
            ->leftJoin('us.vote', 'v', 'WITH', 'us.userSkillId = v.userkill')
            ->addgroupBy('us.userSkillId')
            ->orderBy('rate', 'DESC')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery();
        return $qb->getResult();

    }
}


