<?php

namespace App\Controller;

use App\Repository\LogsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountLogsController extends AbstractController
{
    #[Route(path: [
        'en' => '/account/login-activity',
        'de' => '/konto/login-aktivität',
        'es' => '/cuenta/actividad-de-inicio-de-sesión',
        'fr' => '/compte/activite-de-connexion',
        'it' => '/conto/attività-di-accesso',
    ], name: 'app_account_logs')]
    public function index(LogsRepository $logsRepository): Response
    {
        $logs = $logsRepository->findByUser($this->getUser());

        return $this->render('account/show_logs.html.twig', [
            'logs' => $logs
        ]);
    }
}
