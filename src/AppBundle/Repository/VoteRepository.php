<?php 
// src/AppBundle/Repository/VoteRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class VoteRepository extends EntityRepository
{
    public function findAllCounter()
    {
      $query =  $this->getEntityManager()
          ->createQuery(
            "SELECT v, us, COUNT(us) as total FROM AppBundle:Vote v join v.userkill us group by us");
          try {
              return $query->getScalarResult();
          } catch (\Doctrine\ORM\NoResultException $e) {
              return null;
          }
    }
}
