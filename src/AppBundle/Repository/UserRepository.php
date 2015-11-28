<?php 
// src/AppBundle/Repository/UserRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findBySearch($name)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT u FROM AppBundle:User u
	            WHERE u.name LIKE :name 
   				OR u.lastName LIKE :name  
   				OR u.surName LIKE :name
   				OR CONCAT (u.name,' ',u.lastName) like :name
   				OR CONCAT (u.name,' ',u.surName) like :name
   				OR CONCAT (u.name,' ',u.lastName,' ',u.surName) like :name
   				OR CONCAT (u.lastName,' ',u.surName) like :name"
            )->setParameter('name', '%' . $name . '%');

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function lastUpdates()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('u')
            ->addSelect('MAX(us.userSkillId) as HIDDEN maxSkill')
            ->from('AppBundle:User', 'u')
            ->leftJoin('u.skills', 'us', 'WITH', 'us.user = u.userId')
            ->addgroupBy('u.userId')
            ->orderBy('maxSkill', 'DESC')
            ->setMaxResults(12)
            ->getQuery();
        return $qb->getResult();
    }

    public function usersRating()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder()
            ->select('u')
            ->addSelect('COUNT(v.user) as hidden rate')
            ->from('AppBundle:User', 'u')
            ->leftJoin('u.skills', 'us', 'WITH', 'us.user = u.userId')
            ->leftJoin('us.vote', 'v', 'WITH', 'us.userSkillId = v.userkill')
            ->addgroupBy('us.userSkillId')
            ->orderBy('rate', 'DESC')
            ->getQuery();
        return $qb->getResult();
    }
}


