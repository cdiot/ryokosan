<?php

namespace App\Controller;

use App\Entity\ProfilePicture;
use App\Form\EditProfileType;
use App\Repository\ProfilePictureRepository;
use App\Repository\UserRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function edit(Request $request, UserRepository $userRepository, ProfilePictureRepository $profilePictureRepository, FileUploader $fileUploader, TranslatorInterface $translator): Response
    {
        $user = $this->getUser();



        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('files')->getData();

            $newFilename = $fileUploader->upload($image);
            $profilePicture = new ProfilePicture;
            $profilePicture->setFileName($newFilename);
            $profilePicture->setUser($user);
            $profilePictureRepository->add($profilePicture, true);

            $userRepository->add($user, true);

            $this->addFlash('success', $translator->trans('notification.account_updated'));

            return $this->redirectToRoute('app_account_edit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit_profile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route(path: [
        'en' => '/delete/picture/{id}',
        'de' => '/löschen/bild/{id}',
        'es' => '/borrar/imagen/{id}',
        'fr' => '/supprimer/image/{id}',
        'it' => '/cancella/immagine/{id}',
    ], name: 'app_delete_picture', methods: ['DELETE'])]
    public function deleteImage(ProfilePicture $profilePicture, ProfilePictureRepository $profilePictureRepository, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $profilePicture->getId(), $data['_token'])) {
            $name = $profilePicture->getFileName();
            unlink($this->getParameter('images_directory') . '/' . $name);
            $profilePictureRepository->remove($profilePicture, true);

            return new JsonResponse([
                'success' => 1
            ]);
        }
    }
}
