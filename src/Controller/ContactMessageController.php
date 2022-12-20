<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactMessageController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $user = $this->getUser();
        $option = $user instanceof User ? ['user' => $user] : [];
        $form = $this->createForm(ContactType::class, null, $option);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new Email())
                ->from($contactFormData->getMail())
                ->to('fifa.world.bk@gmail.com')
                ->subject($contactFormData->getSujet())
                ->html('Sender : ' . $contactFormData->getMail() . \PHP_EOL .
                    $contactFormData->getMessage(),
                    'text/plain');
            $mailer->send($message);

            $this->addFlash('success', 'Votre demande de contact à bien été envoyer');

            $em->persist($contactFormData);
            $em->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}