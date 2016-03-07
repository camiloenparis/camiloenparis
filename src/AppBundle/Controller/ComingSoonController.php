<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComingSoonController extends Controller
{
    /**
     * @Route("/comingSoon", name="_comingSoon")
     */

    public function indexAction()
    {
        return $this->render('comingSoon.html.twig');
    }
}
