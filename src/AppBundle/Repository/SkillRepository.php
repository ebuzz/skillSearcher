<?php
// src/AppBundle/Repository/SkillRepository.php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SkillRepository extends EntityRepository
{
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

    public function findByCount($id)
    {
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT COUNT(v.userkill) as total FROM AppBundle:Vote v  where v.userkill = :id"
            )->setParameter('id', $id);

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
