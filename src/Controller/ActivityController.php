<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\ActivityType;
use App\Repository\ActivityRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ActivityController extends AbstractController
{
    #[Route(path: [
        'en' => '/activity',
        'de' => '/aktivität',
        'es' => '/actividad',
        'fr' => '/activite',
        'it' => '/attività',
    ], name: 'app_activity_index', methods: ['GET'])]
    public function index(ActivityRepository $activityRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $activityRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('activity/index.html.twig', ['pagination' => $pagination]);
    }

    #[Route(path: [
        'en' => '/activity/new',
        'de' => '/aktivität/neu',
        'es' => '/actividad/nuevo',
        'fr' => '/activite/nouveau',
        'it' => '/attività/nuovo',
    ], name: 'app_activity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivityRepository $activityRepository, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->setUser($this->getUser());
            $activity->setCreatedAt(new DateTime());
            $activityRepository->add($activity, true);

            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activity/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route(path: [
        'en' => '/activity/{id}/edit',
        'de' => '/aktivität/{id}/edit',
        'es' => '/actividad/{id}/editar',
        'fr' => '/activite/{id}/modifier',
        'it' => '/attività/{id}/modifica',
    ], name: 'app_activity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activity $activity, ActivityRepository $activityRepository): Response
    {
        $this->denyAccessUnlessGranted('activity_manage', $activity);

        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activityRepository->add($activity, true);

            return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activity/edit.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route(path: [
        'en' => '/activity/{id}',
        'de' => '/aktivität/{id}',
        'es' => '/actividad/{id}',
        'fr' => '/activite/{id}',
        'it' => '/attività/{id}',
    ], name: 'app_activity_delete', methods: ['POST'])]
    public function delete(Request $request, Activity $activity, ActivityRepository $activityRepository): Response
    {
        $this->denyAccessUnlessGranted('activity_manage', $activity);

        if ($this->isCsrfTokenValid('delete' . $activity->getId(), $request->request->get('_token'))) {
            $activityRepository->remove($activity, true);
        }

        return $this->redirectToRoute('app_activity_index', [], Response::HTTP_SEE_OTHER);
    }
}
