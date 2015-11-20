<?php
// src/AppBundle/Repository/PositionRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PositionRepository extends EntityRepository
{
    public function findBySearch($name)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT u FROM AppBundle:User u, AppBundle:Position p WHERE p.name LIKE :name"
            )->setParameter('name', '%' . $name . '%');

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}


