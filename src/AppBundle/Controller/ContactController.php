<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Form\ContactForm;
use AppBundle\Mailer\MailerClass;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Session\Session;


class ContactController extends Controller
{
    /**
     * @Route("/contact", name="_contact")
     * @Method({"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $contactForm = $this->createForm(ContactForm::class);
        $contactForm->handleRequest($request);

        // if the form was submited and is valid (POST)
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {

            // build the message object and set the date time to 'now'
            $message = new Message();
            $message->setName($contactForm->get('name')->getData());
            $message->setEmail($contactForm->get('email')->getData());
            $message->setSubject($contactForm->get('subject')->getData());
            $message->setText($contactForm->get('text')->getData());
            $message->setDate(new \DateTime());


            // persist to database
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            // send an email to Camilo with this message
            $mailer = new MailerClass();
            $mailer->sendContactEmail
            (
                $contactForm->get('email')->getData(),
                $contactForm->get('email')->getData(),
                $contactForm->get('subject')->getData(),
                $contactForm->get('text')->getData()
            );

            // add a flashback message
            $this->get('session')->getFlashBag()->add(
                'notice',
                array(
                    'alert' => 'success',
                    'title' => 'Success!',
                    'message' => 'Your message has been received, I will reply as soon as possible!'
                )
            );

            // send back to the home page
            return $this->redirect($this->generateUrl('_home'));
        }

        // if the user has not yet submitted the form (GET)
        return $this->render('contact.html.twig', array(
            'form' => $contactForm->createView()
        ));



    }




}
