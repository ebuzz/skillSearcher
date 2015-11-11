<?php 
// src/AppBundle/Repository/SkillRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SkillRepository extends EntityRepository
{
	public function findBySearch($name)
    {
        $query =  $this->getEntityManager()
	        ->createQuery(
	            "SELECT u FROM AppBundle:User u
	            WHERE u.name LIKE :name 
   				OR u.lastName LIKE :name  
   				OR u.surName LIKE :name
   				OR concat (u.name,' ',u.lastName) like :name
   				OR concat (u.name,' ',u.surName) like :name
   				OR concat (u.name,' ',u.lastName,' ',u.surName) like :name
   				OR concat (u.lastName,' ',u.surName) like :name"
	        )->setParameter('name', '%' . $name . '%');

    	    try {
    	        return $query->getResult();
    	    } catch (\Doctrine\ORM\NoResultException $e) {
    	        return null;
    	    }
	    }
      
  public function findByComplete($name)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT s FROM AppBundle:Skill s
              WHERE s.name LIKE :name"
            )->setParameter('name', '%' . $name . '%');

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
