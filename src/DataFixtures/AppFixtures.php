<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Destination;
use App\Entity\Logs;
use App\Entity\User;
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
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$password, $email, $roles, $gender, $firstname, $birthday, $geolocalisation, $sponsorship]) {
            $user = new User();
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setIsVerified(true);
            $user->setGender($gender);
            $user->setFirstname($firstname);
            $user->setBirthday($birthday);
            $user->setGeolocalisation($geolocalisation);
            $user->setSponsorship($sponsorship);
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

    private function getUserData(): array
    {
        return [
            // $userData = [$password, $email, $roles, $gender, $firstname, $birthday, $geolocalisation, $sponsorship];
            ['123456', 'foo@gmail.com', ['ROLE_USER'], 'f', 'Mandy', new DateTimeImmutable('2003-10-18'), 'GB', 'mandy'],
            ['123456', 'foobar@gmail.com', ['ROLE_USER'], 'f', 'Riley', new DateTimeImmutable('2004-09-21'), 'FR', 'riley'],
            ['123456', 'baz@gmail.com', ['ROLE_USER'], 'o', 'Blu', new DateTimeImmutable('1999-12-31'), 'DE', 'Blu'],
            ['123456', 'bar@ryokosan.com', ['ROLE_ADMIN'], 'm', 'Eliot', new DateTimeImmutable('2003-05-03'), 'FR', ''],
            ['123456', 'hoge@live.com', ['ROLE_USER'], 'f', 'Diego', new DateTimeImmutable('1999-08-14'), 'ES', ''],
            ['123456', 'fuga@hotmail.com', ['ROLE_USER'], 'f', 'Noah', new DateTimeImmutable('1998-07-19'), 'GB', ''],
            ['123456', 'piyo@gmail.com', ['ROLE_USER'], 'o', 'Fry', new DateTimeImmutable('1997-11-13'), 'GB', 'Blu'],
            ['123456', 'hogera@orange.fr', ['ROLE_USER'], 'm', 'Abraham', new DateTimeImmutable('2002-04-05'), 'DE', ''],
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
            //[$user, $createdAt, $startDate, $endDate, $description]
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
}
