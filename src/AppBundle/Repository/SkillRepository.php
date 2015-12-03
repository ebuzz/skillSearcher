<?php
// src/AppBundle/Repository/SkillRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SkillRepository extends EntityRepository
{
    public function completeSkill($name)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('s')
            ->from('AppBundle:Skill', 's')
            ->where('s.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery();
        return $qb->getResult();
    }

    public function searchSkill($name)
    {
        $em = $this->getEntityManager();
        $subQuery = $em->createQueryBuilder()
            ->select('s.skillId')
            ->from('AppBundle:Skill', 's')
            ->where('s.name LIKE :name')
            ->setParameter('name', $name)
            ->getQuery();
        $skillId = $subQuery->getScalarResult();

        $qb = $em->createQueryBuilder()
            ->select('u')
            ->addSelect('COUNT(v.userkill) as hidden rate')
            ->from('AppBundle:User', 'u')
            ->leftJoin('u.skills', 'us', 'WITH', 'us.user = u.userId')
            ->leftJoin('us.vote', 'v', 'WITH', 'us.userSkillId = v.userkill')
            ->addgroupBy('us.userSkillId')
            ->orderBy('rate', 'DESC')
            ->where('us.skill = :skillId')
            ->setParameter('skillId', $skillId)
            ->getQuery();
        return $qb->getResult();
    }
}
