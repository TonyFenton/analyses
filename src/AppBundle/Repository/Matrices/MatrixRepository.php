<?php

namespace AppBundle\Repository\Matrices;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Matrices\Matrix;

class MatrixRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFindMatricesQuery()
    {
        return $this->getEntityManager()->getRepository(Matrix::class)->createQueryBuilder('m')->getQuery();
    }
}
