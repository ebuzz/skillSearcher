<?php 
// src/AppBundle/Repository/AccountRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
	public function findBySearch($name)
    {
        $query =  $this->getEntityManager()
	        ->createQuery(
	            "SELECT u FROM AppBundle:User u, AppBundle:Account ac
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
}
