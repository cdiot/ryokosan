<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Message;
use App\Repository\GroupRepository;
use App\Form\GroupFormType;
use App\Form\MessageFormType;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagingController extends AbstractController
{
    private $entityManager;
    private $formFactory;

    /**
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    #[Route(path: [
        'en' => '/messaging',
        'de' => '/Nachrichtenübermittlung',
        'es' => '/mensajería',
        'fr' => '/messagerie',
        'it' => '/messaggistica',
    ], name: 'app_group_index')]
    public function index(GroupRepository $groupRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        # Collect information from user conversations
        $query = $groupRepository->groupsOfUser($this->getUser()->getUserIdentifier());

        return $this->render('messaging/index.html.twig', [
            'user' => $this->getUser(),
            'groups' => $query,
        ]);
    }

    #[Route(path: [
        'en' => '/conversation/new',
        'de' => '/gespräch/neu',
        'es' => '/conversación/nuevo',
        'fr' => '/conversation/nouveau',
        'it' => '/conversazione/nuovo',
    ], name: 'app_group_new')]
    public function createConversation(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $newGroup = new Group();
        $groupType = new GroupFormType();
        $form = $this->formFactory->createNamedBuilder($groupType->getBlockPrefix() . 'add', GroupFormType::class, $newGroup, ['id' => $this->getUser()->getId()])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newGroup->setCreatedAt(new DateTimeImmutable());
            $newGroup->setUpdatedAt(new DateTime());
            $newGroup->addUserToGroups($this->getUser());
            $this->entityManager->persist($newGroup);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('messaging/new_group.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: [
        'en' => '/conversation/{id}',
        'de' => '/gespräch/{id}',
        'es' => '/conversación/{id}',
        'fr' => '/conversation/{id}',
        'it' => '/conversazione/{id}',
    ], name: 'app_chat')]
    public function chat($id, Request $request, UserRepository $userRepository, GroupRepository $groupRepository, MessageRepository $messageRepository): Response
    {
        $user = $userRepository->user($this->getUser()->getUserIdentifier());
        $userInConv = $userRepository->userInGroup($user[0]->getId());
        $group = $groupRepository->oneGroup($id);
        $messages = $messageRepository->messagesOfGroup($group);

        $newMessage = new Message();
        $form = $this->createForm(MessageFormType::class, $newMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newMessage->setCreatedAt(new DateTimeImmutable());
            $newMessage->setUser($this->getUser());
            $newMessage->addMessageToGroup($this->entityManager->getReference(Group::class, $id));
            $this->entityManager->persist($newMessage);
            $this->entityManager->flush();
            $this->redirectToRoute('app_chat', ['id' => $id]);
        }

        return $this->render('messaging/chat.html.twig', [
            'user' => $this->getUser(),
            'userInConv' => $userInConv,
            'group' => $group,
            'messages' => $messages,
            'form' => $form->createView()
        ]);
    }
}
