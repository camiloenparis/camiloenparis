<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Project;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Questions;



class QuestionsRepository extends EntityRepository
{
    /**
     * @return Questions[]
     */
    public function findAllRecentQuestionsForProject(Project $project)
    {
        return $this->createQueryBuilder('XXX')
            ->andWhere('XXX.project = :project')
            ->setParameter('project', $project)
            ->andWhere('XXX.createdAt > :recentDate')
            ->setParameter('recentDate', new \DateTime('-3 months'))
            ->getQuery()
            ->execute();
    }

} 