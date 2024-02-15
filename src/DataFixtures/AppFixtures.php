<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for($u = 0; $u < 10; $u++) {
            $user = new User;
            $user->setName($faker->unique()->name());
            $user->setRoles(['ROLE_ADMIN']);
            $plaintextPassword = 'pwd123';
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);
            $user->setEmail($faker->email);
            $user->setCreatedAt(new DateTimeImmutable($faker->date()));
            $user->setUpdatedAt(new \DateTimeImmutable($faker->date()));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
