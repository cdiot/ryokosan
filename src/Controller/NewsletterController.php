<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\SubscriberType;
use App\Repository\SubscriberRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class NewsletterController extends AbstractController
{
    #[Route(path: [
        'en' => '/newsletter',
        'de' => '/newsletter',
        'es' => '/boletines',
        'fr' => '/newsletter',
        'it' => '/newsletter',
    ], name: 'app_newsletter')]
    public function index(Request $request, SubscriberRepository $subscriberRepository, MailerInterface $mailer, TranslatorInterface $translator): Response
    {
        $subscriber = new Subscriber();
        $form = $this->createForm(SubscriberType::class, $subscriber);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = hash('sha256', uniqid());

            $subscriber->setValidationToken($token);
            $subscriber->setIsValid(false);

            $subscriberRepository->add($subscriber, true);

            $email = (new TemplatedEmail())
                ->from('newsletter@ryokosan.com')
                ->to($subscriber->getEmail())
                ->subject('email.subject.subscription')
                ->htmlTemplate('emails/subscription.html.twig')
                ->context(compact('subscriber', 'token'));

            $mailer->send($email);

            $this->addFlash('message', $translator->trans('notification.subscription_send'));
            return $this->redirectToRoute('app_newsletter');
        }

        return $this->render('newsletter/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: [
        'en' => '/newsletter/confirm/{id}/{token}',
        'de' => '/newsletter/confirm/{id}/{token}',
        'es' => '/boletines/confirmar/{id}/{token}',
        'fr' => '/newsletter/confirmer/{id}/{token}',
        'it' => '/newsletter/conferma/{id}/{token}',
    ], name: 'app_newsletter_confirm')]
    public function confirm(Subscriber $subscriber, SubscriberRepository $subscriberRepository, TranslatorInterface $translator, $token): Response
    {
        if ($subscriber->getValidationToken() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }

        $subscriber->setIsValid(true);

        $subscriberRepository->add($subscriber, true);

        $this->addFlash('message', $translator->trans('notification.subscription_verified'));

        return $this->redirectToRoute('app_newsletter');
    }
}
