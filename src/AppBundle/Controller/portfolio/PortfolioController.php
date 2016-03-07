<?php


namespace AppBundle\Controller\portfolio;


use AppBundle\Entity\Project;
use AppBundle\Entity\Skill;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Mapping as ORM;



class PortfolioController extends Controller
{

    // CONTROLLER FUNCITONS

    /**
     * @Route("/portfolio", name="_portfolio")
     * @Method("GET")
     */

    public function showPortfolio()
    {
        // Get the portfolio
        $portfolio = $this->getPortfolio();

        return $this->render('portfolio/portfolio.html.twig', [
            'portfolio' => $portfolio
        ]);
    }


    /**
     * @Route("/portfolio/{projectName}", name="{project_show}")
     * @Method("GET")
     */

    public function showProject($projectName)
    {
        // check if the project name exists
        $project = $this->checkIfProjectExists($projectName);
        if($project == false)
        {
            $portfolio = $this->getPortfolio();
            return $this->render('portfolio/portfolio.html.twig', [
                'portfolio' => $portfolio
            ]);
        }


        // otherwise, send to the general portfolio page
        else
        {
            return $this->render('portfolio/project/project.html.twig', [

                'project'       => $project,
                'projectName'   => $projectName
            ]);
        }
    }



    // MODEL FUNCTIONS

    public function checkIfProjectExists($projectName)
    {
        // check if the project exists
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p, s
            FROM AppBundle:Project p
            JOIN p.skills s
            WHERE p.name = :name'
        )->setParameter('name', $projectName);

        $project = $query->getResult();

        if (empty($project))
        {
            return false;
        }
        else
        {
            return $project;
        }
    }

    public function getPortfolio()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM AppBundle:Project p'
        );

        $portfolio = $query->getResult();
        return $portfolio;
    }

} 