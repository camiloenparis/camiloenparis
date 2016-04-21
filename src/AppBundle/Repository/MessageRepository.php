<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Project;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Message;
use AppBundle\Entity\Questions;



class MessageRepository extends EntityRepository
{
    /**
     * @return Message[]
     */
    public function findAllPublishedMessagesOrderedByDate()
    {
        return $this->createQueryBuilder('message')
            ->andWhere('message.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('message.date', 'DESC')
            ->getQuery()
            ->execute();
    }

} 