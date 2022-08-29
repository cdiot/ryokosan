<?php

namespace App\EventListener;

use App\Entity\Logs;
use DateTime;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class AuthenticationListener
{
    public function __construct(private $doctrine, private $request)
    {
        $this->doctrine = $doctrine;
        $this->request = $request;
    }

    /**
     * onAuthenticationSuccess
     *
     * @param InteractiveLoginEvent $event
     */
    public function onAuthenticationSuccess(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $this->saveLogs($user, true);
    }

    /**
     * saveLogs 
     */
    private function saveLogs($user, bool $isSuccess)
    {
        $logs = new Logs();
        $logs->setUser($user);
        $logs->setDate(new DateTime());
        $logs->setIp($this->request->getCurrentRequest()->getClientIp());
        $logs->setIsSuccess($isSuccess);

        $em = $this->doctrine->getManager();
        $em->persist($logs);
        $em->flush();
    }
}
