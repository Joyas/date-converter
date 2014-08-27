<?php
 
namespace TH\DateConverter\Bundle\Entity;

use Doctrine\ORM\EntityRepository;

class KingRepository extends EntityRepository
{    
    public function getKingByName($name)
    {
          return $this->getEntityManager()
            ->createQuery(
                'SELECT k FROM THDateConverterBundle:King k WHERE LOWER(k.name) = LOWER(\'' . $name . '\')'
            )
            ->getResult();
    }
}