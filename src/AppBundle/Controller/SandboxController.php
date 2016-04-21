<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Project;
use AppBundle\Entity\Questions;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SandboxController extends Controller
{
    /**
     * @Route("/sandbox", name="_sandbox_input")
     */
    public function newAction(Request $request)
    {

        // todo - add the caching back later
        /*
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($funFact);
        if ($cache->contains($key)) {
            $funFact = $cache->fetch($key);
        } else {
            sleep(1); // fake how slow this could be
            $funFact = $this->get('markdown.parser')
                ->transform($funFact);
            $cache->save($key, $funFact);
        }

        $message = new Message();
        $message->setSubject('getting better now');
        $message->setDate(new \DateTime('now'));
        $message->setEmail('test@camilo.fr');
        $message->setText('This is my third entry in the database done with doctrine');



        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();


        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Project')
            ->find(3); // sunnyblanket

        $question = new Questions();
        $question->setUserName('Orlando');
        $question->setUserAvatarId(8);
        $question->setNote('De verdad hiciste esto tu solito Camilito?');
        $question->setCreatedAt(new \DateTime('-1 month'));
        $question->setProject($project);

        $em->persist($question);
        $em->flush();
        */

        return $this->render('sandbox.html.twig');

    }

    /**
     * @Route("/sandbox/output", name="_sandbox_output")
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('AppBundle:Message')
            ->findAllPublishedMessagesOrderedByDate();
        return $this->render('sandbox.html.twig', array(
            'messages' => $messages));
    }

    /**
     * @Route("/sandbox/cookie", name="_sandbox_cookie")
     */
    public function showCookie(Request $request)
    {
        $categoryRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Category');

        $search = $request->query->get('q');
        if ($search) {
            $fortuneCookies = $categoryRepository->search($search);
        } else {
            $fortuneCookies = $categoryRepository->findAllOrdered();
        }


        return $this->render('sandbox.html.twig', array(
            'fortuneCookies' => $fortuneCookies));
    }


}
