<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class AccountController extends AbstractController
{
    #[Route(path: [
        'en' => '/account/edit',
        'de' => '/konto/bearbeiten',
        'es' => '/cuenta/editar',
        'fr' => '/compte/editer',
        'it' => '/conto/modifica',
    ], name: 'app_account_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, TranslatorInterface $translator): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            $this->addFlash('success', $translator->trans('notification.account_updated'));

            return $this->redirectToRoute('app_account_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit_profile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
