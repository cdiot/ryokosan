<?php

namespace App\DataFixtures;

use App\Entity\Logs;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private array $users = [];

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadLogs($manager);
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

    private function getUserData(): array
    {
        return [
            // $userData = [$password, $email, $roles, $gender, $firstname, $birthday, $geolocalisation, $sponsorship];
            ['123456', 'foo@gmail.com', ['ROLE_USER'], 'f', 'Mandy', new DateTimeImmutable('2003-10-18'), 'GB', 'mandy'],
            ['123456', 'foobar@gmail.com', ['ROLE_USER'], 'f', 'Riley', new DateTimeImmutable('2004-09-21'), 'FR', 'riley'],
            ['123456', 'baz@gmail.com', ['ROLE_USER'], 'o', 'Blu', new DateTimeImmutable('1999-12-31'), 'DE', 'Blu'],
            ['123456', 'bar@gmail.com', ['ROLE_ADMIN'], 'm', 'Eliot', new DateTimeImmutable('2003-05-03'), 'FR', ''],
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
}
