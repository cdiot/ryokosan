<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    #[Route(path: [
        'en' => '/contact-us',
        'de' => '/kontaktiere-uns',
        'es' => '/Contáctenos',
        'fr' => '/nous-contacter',
        'it' => '/contattaci',
    ], name: 'app_contact')]
    public function index(Request $request, Mailer $mailer, TranslatorInterface $translator)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->addFlash('notice', $translator->trans('notification.team_respond'));
            $mailer->send(
                $data['subject'],
                $data['email'],
                'contact@ryokosan.com',
                'emails/contact.html.twig',
                [
                    'content' => $data['content'],
                ]
            );
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
