<?php

namespace App\DataFixtures;

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
}
