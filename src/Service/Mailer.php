<?php

namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class Mailer
{
    /**
     * MailerService constructor.
     *
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(
        private MailerInterface $mailer,
        private Environment $twig
    ) {
    }

    /**
     * @param string $subject
     * @param string $from
     * @param string $to
     * @param string $template
     * @param array $parameters
     * @throws TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function send(string $subject, string $from, string $to, string $template, array $parameters): void
    {
        try {
            $email = (new Email())
                ->from($from)
                ->to($to)
                ->subject($subject)
                ->html(
                    $this->twig->render($template, $parameters)
                );

            $this->mailer->send($email);
        } catch (TransportException $e) {
            print $e->getMessage() . "\n";
            throw $e;
        }
    }
}
