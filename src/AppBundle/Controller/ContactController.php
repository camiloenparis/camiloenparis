<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Mapping as ORM;



class ContactController extends Controller
{
    /**
     * @Route("/contact", name="_contact")
     */

    public function newAction(Request $request)
    {
        $message = new Message();
        $contactForm = $this->createForm(ContactType::class, $message);

        $form = $this->createFormBuilder($contactForm)
            ->add('email', TextType::class)
            ->add('message', TextType::class)
            ->add('subject', TextType::class)
            ->add('date', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        // if the form is sumbited
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            // persist to database

            return $this->redirect($this->generateUrl('_home')
            );
        }

        return $this->render('contact.html.twig', array(
            'form' => $form->createView()
        ));


    }

}
