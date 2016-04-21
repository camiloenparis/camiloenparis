<?php


namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{

    public function findAllOrdered()
    {
        /*
        $dql = 'SELECT cat FROM AppBundle\Entity\Category cat ORDER BY cat.name ASC';

        $query = $this->getEntityManager()->createQuery($dql);
        */
        $qb = $this->createQueryBuilder('cat')
            ->addOrderBy('cat.name', 'ASC');
        $query = $qb->getQuery();


        return $query->execute();
    }

    public function search($term)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql =
                "SELECT Name, iconKey, fortune
                FROM category
                INNER JOIN fortune_cookie
                ON category.id=fortune_cookie.category_id
                WHERE Name LIKE :term OR iconKey = :iconKey";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('term', $term);
        $stmt->bindValue('iconKey', 2);
        $stmt->execute();
        return $stmt->fetchAll();

    }

}