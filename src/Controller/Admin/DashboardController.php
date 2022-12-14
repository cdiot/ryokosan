<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Rubric;
use App\Entity\User;
use App\Repository\ActivityRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        protected UserRepository $userRepository,
        protected ActivityRepository $activityRepository,
    ) {
    }

    #[Route(path: [
        'en' => '/admin',
        'de' => '/admin',
        'es' => '/admin',
        'fr' => '/admin',
        'it' => '/admin',
    ], name: 'admin')]
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->userRepository->countAllUser(),
            'countAllActivity' => $this->activityRepository->countAllActivity(),
            'countAllSponsorshipByUser' => $this->userRepository->countAllSponsorshipByUser(),
        ]);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ryokosan');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('menu.back_to_site', 'fas fa-undo', 'app_home');
        yield MenuItem::linkToDashboard('menu.dashboard', 'fa fa-home');
        yield MenuItem::subMenu('menu.accounts', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('menu.all_accounts', 'fas fa-user-friends', User::class),
            MenuItem::linkToCrud('menu.add', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)
        ]);
        yield MenuItem::linkToCrud('label.rubrics', 'fas fa-list', Rubric::class);

        // -------------
        yield MenuItem::subMenu('menu.articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('menu.all_articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('menu.add', 'fas fa-plus', Article::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('menu.categories', 'fas fa-list', Category::class)
        ]);

        yield MenuItem::subMenu('menu.medias', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('menu.media_library', 'fas fa-photo-video', Media::class),
            MenuItem::linkToCrud('menu.add', 'fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}
