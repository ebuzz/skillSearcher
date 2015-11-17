<?php 
// src/AppBundle/Repository/UserRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findBySearch($name)
    {
        $query =  $this->getEntityManager()
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

    public function findAllLastUsers()
    {
      $query =  $this->getEntityManager()
          ->createQuery(
            "SELECT u, MAX(us.userSkillId) AS HIDDEN maxSkill FROM AppBundle:User u,AppBundle:UserSkill  us WHERE u.userId=us.user  GROUP BY u.userId ORDER BY  maxSkill DESC") 
          ->setMaxResults(6);
          try {
              return $query->getResult();
          } catch (\Doctrine\ORM\NoResultException $e) {
              return null;
          }
    }
}