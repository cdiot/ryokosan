<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Destination;
use App\Entity\Logs;
use App\Entity\Rubric;
use App\Entity\User;
use DateTime;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private array $users = [];
    private array $activities = [];

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadLogs($manager);
        $this->loadActivities($manager);
        $this->loadDestinations($manager);
        $this->loadRubrics($manager);
        $this->loadArticles($manager);
        $this->loadCategories($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$password, $email, $roles, $gender, $username, $birthday, $geolocalisation, $sponsorship, $bio]) {
            $user = new User();
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setIsVerified(true);
            $user->setGender($gender);
            $user->setUsername($username);
            $user->setBirthday($birthday);
            $user->setGeolocalisation($geolocalisation);
            $user->setSponsorship($sponsorship);
            $user->setBio($bio);
            $manager->persist($user);
            $this->users[] = $user;
        }
        $manager->flush();
    }

    private function loadLogs(ObjectManager $manager): void
    {
        foreach ($this->getLogsData() as [$date, $ip, $isSuccess, $user]) {
            $logs = new Logs();
            $logs->setDate($date);
            $logs->setIp($ip);
            $logs->setIsSuccess($isSuccess);
            $logs->setUser($this->users[$user]);
            $manager->persist($logs);
        }
        $manager->flush();
    }

    private function loadActivities(ObjectManager $manager): void
    {
        foreach ($this->getActivityData() as [$user, $createdAt, $startDate, $endDate, $description]) {
            $activity = new Activity();
            $activity->setCreatedAt($createdAt)
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setDescription($description)
                ->setUser($this->users[$user]);
            $manager->persist($activity);
            $this->activities[] = $activity;
        }
        $manager->flush();
    }

    private function loadDestinations(ObjectManager $manager): void
    {
        foreach ($this->getDestinationsData() as [$name]) {
            $destinations = new Destination();
            $destinations->setName($name);
            $manager->persist($destinations);
        }
        $manager->flush();
    }

    private function loadRubrics(ObjectManager $manager): void
    {
        foreach ($this->getRubricsData() as [$name]) {
            $rubrics = new Rubric();
            $rubrics->setName($name);
            $manager->persist($rubrics);
        }
        $manager->flush();
    }

    private function loadArticles(ObjectManager $manager): void
    {
        foreach ($this->getArticleData() as [$title, $slug, $content, $featuredText]) {
            $article = new Article();
            $article->setTitle($title)
                ->setSlug($slug)
                ->setContent($content)
                ->setFeaturedText($featuredText)
                ->setCreatedAt(new DateTime())
                ->setIsPublished(true);
            $manager->persist($article);
        }
        $manager->flush();
    }

    private function loadCategories(ObjectManager $manager): void
    {
        foreach ($this->getCategoryData() as [$name, $slug, $color]) {
            $category = new Category();
            $category->setName($name)
                ->setSlug($slug)
                ->setColor($color);
            $manager->persist($category);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            // $userData = [$password, $email, $roles, $gender, $username, $birthday, $geolocalisation, $sponsorship, $bio];
            ['123456', 'foo@gmail.com', ['ROLE_USER'], 'f', 'Mandy', new DateTimeImmutable('2003-10-18'), 'GB', 'mandy', 'I am not a chatty person but a good listener.'],
            ['123456', 'foobar@gmail.com', ['ROLE_USER'], 'f', 'Riley', new DateTimeImmutable('2004-09-21'), 'FR', 'riley', 'coucou'],
            ['123456', 'baz@gmail.com', ['ROLE_USER'], 'o', 'Blu', new DateTimeImmutable('1999-12-31'), 'DE', 'Blu', 'I\'m a fan of the United States, especially the West. Ask me anything about it.'],
            ['123456', 'bar@ryokosan.com', ['ROLE_ADMIN'], 'm', 'Eliot', new DateTimeImmutable('2003-05-03'), 'FR', '', 'Contact me for any travel plans :)'],
            ['123456', 'hoge@live.com', ['ROLE_USER'], 'f', 'Diego', new DateTimeImmutable('1999-08-14'), 'ES', '', 'El invierno es la mejor estación. Soy alérgico al sol.'],
            ['123456', 'fuga@hotmail.com', ['ROLE_USER'], 'f', 'Noah', new DateTimeImmutable('1998-07-19'), 'GB', '', 'I love french food!'],
            ['123456', 'piyo@gmail.com', ['ROLE_USER'], 'o', 'Fry', new DateTimeImmutable('1997-11-13'), 'GB', 'Blu', 'Nothing special to say.'],
            ['123456', 'hogera@orange.fr', ['ROLE_USER'], 'm', 'Abraham', new DateTimeImmutable('2002-04-05'), 'DE', '', 'Ich bin in der Finanzbranche tätig und mag das Land der Sonne.'],
        ];
    }

    private function getLogsData(): array
    {
        return [
            // $logsData = [$date, $ip, $isSuccess, $user];
            [new DateTimeImmutable('2022-08-18 10:10:15'), '168.212.226.204', true, 2],
            [new DateTimeImmutable('2022-08-21 21:07:13'), '192.168.1.1', true, 0],
            [new DateTimeImmutable('2022-08-31 10:34:05'), '127.0.0.1', true, 1],
            [new DateTimeImmutable('2022-08-03 07:45:09'), '192.0.0.7', true, 0],
            [new DateTimeImmutable('2022-08-18 11:18:04'), '172.16.0.9', true, 3],
            [new DateTimeImmutable('2022-08-21 13:27:52'), '192.155.87.0', true, 3],
            [new DateTimeImmutable('2022-08-31 15:23:48'), '192.168.1.2', true, 1],
            [new DateTimeImmutable('2022-08-03 22:44:18'), '212.85.150.133', true, 0],
        ];
    }

    private function getActivityData(): array
    {
        return [
            // $ActivityData = [$user, $createdAt, $startDate, $endDate, $description]
            [0, new DateTimeImmutable('2022-12-18'), new DateTimeImmutable('2023-01-17'), new DateTimeImmutable('2023-03-26'), 'Excited to travel around Asia. I have no plan, just enjoy.'],
            [1, new DateTimeImmutable('2022-08-15'), new DateTimeImmutable('2022-10-18'), new DateTimeImmutable('2022-12-24'), 'I am plan to visit the West Coast of the United States. This will be my first trip.'],
            [2, new DateTimeImmutable('2023-09-21'), new DateTimeImmutable('2023-11-22'), new DateTimeImmutable('2024-11-22'), 'I go to Canada with working holiday visa around october 2023 :)'],
            [3, new DateTimeImmutable('2023-01-05'), new DateTimeImmutable('2023-03-01'), new DateTimeImmutable('2023-07-30'), 'J\'organise la première saison de ryokosan Vlog, la destination n\'est pas encore choisi.'],
            [4, new DateTimeImmutable('2022-12-18'), new DateTimeImmutable('2023-01-17'), new DateTimeImmutable('2023-03-26'), 'Quiero ir a ver la aurora boreal en Noruega. Quien viene ?'],
            [5, new DateTimeImmutable('2022-08-15'), new DateTimeImmutable('2022-10-18'), new DateTimeImmutable('2022-12-24'), 'It\'s my first time in Paris, I don\'t have a precise date. I want to see the eiffel tower.'],
            [6, new DateTimeImmutable('2023-09-21'), new DateTimeImmutable('2023-11-22'), new DateTimeImmutable('2024-11-22'), 'Like every year I\'m going to do a hike in Wales and followed by another in Scotland, it\'s wonderful!! :)'],
            [7, new DateTimeImmutable('2023-01-05'), new DateTimeImmutable('2023-03-01'), new DateTimeImmutable('2023-07-30'), 'Ich fahre nach Thailand, um in den neuen Jahren auf der Vollmondparty zu feiern.'],
        ];
    }

    private function getDestinationsData(): array
    {
        return [
            //[$name]
            ['Thailand'],
            ['Malaysia'],
            ['Vietnam '],
            ['Cambodia'],
            ['United States'],
            ['Canada'],
            ['Norway'],
            ['France'],
            ['United Kingdom'],
            ['Japan'],
        ];
    }

    private function getRubricsData(): array
    {
        return [
            //[$name]
            ['Actuality'],
            ['Japan'],
            ['Update'],
        ];
    }

    private function getArticleData(): array
    {
        return [
            // $ArticleData = [$title, $slug, $content, $featuredText, $createdAt]
            ['Are you planning to go to Japan?', 'are-you-planning-to-go-to-japan', 'Eating in the street, showing off your tattoos, talking out loud in the subway... What seems banal to Westerners can surprise or even disconcert the Japanese. Attached to teinei, a notion that encompasses kindness, gentleness or discretion, the inhabitants of Japan can sometimes find it difficult to welcome foreigners because of cultural differences.', 'The extreme courtesy of the Japanese surprises more than one globetrotter. Here are the habits and customs to be respected in the Land of the Rising Sun.'],
            ['French in the conquest of the West', 'french-in-the-conquest-of-the-west', 'On April 7, A captain writes in his diary: “We were about to penetrate at least two thousand miles into the interior of a country, the ground of which no civilized man had yet trod. It has been a year since a famous expedition, sent by the emperor to discover the unknown territories of the west, left St Louis to go up the Missouri by canoe. From there, they will eventually find a passage through the terrifying Rocky Mountains, despite disease, hunger, grizzly bear attacks, to finally reach the Pacific coast. 
                With a primarily scientific objective (cartographic survey, discovery of fauna and flora) the expedition, which responds to clearly expansionist aims, will open the way to what is called the Conquest of the West with its procession of destruction and massacres.', 'A Frenchman who participated in an expedition to the American West between 1800 and 1850 and whose success owes him a lot.'],
            ['Japan hit by Typhoon', 'japan-hit-by-typhoon', 'Along the coast, in the south-east of Japan, in the prefecture of Kochi, the sea was raging: the waves, immense, were several meters high. The roofs were torn off, the trees uprooted, the roads flooded. The inhabitants saw the damage after the passage of the typhoon, Monday, September 19. In a games room, the windows did not resist the power of the winds. Gusts that reached 234 km / h when the typhoon arrived.', 'A typhoon ravaged the coasts of Japan on Monday, September 19. One person died and dozens injured.'],
        ];
    }

    private function getCategoryData(): array
    {
        return [
            // $CategoryData =[$name, $slug, $color]
            ['Ryokosan news', 'ryokosan-news', '#5a4997'],
            ['Travel stories', 'travel-stories', '#33b72a'],
            ['Japan', 'japan', '#d7909'],
        ];
    }
}
