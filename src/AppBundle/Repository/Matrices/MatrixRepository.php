<?php

namespace AppBundle\Repository\Matrices;

use Doctrine\ORM\Query;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Matrix\Matrix;
use AppBundle\Entity\User;

class MatrixRepository extends EntityRepository
{
    public function getFindMatricesQuery(User $user): Query
    {
        return $this->getEntityManager()->getRepository(Matrix::class)->createQueryBuilder('m')
            ->where('m.user = :user')
            ->setParameter('user', $user)
            ->getQuery();
    }
}