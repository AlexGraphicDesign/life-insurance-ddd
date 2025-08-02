<?php

declare(strict_types=1);

namespace DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Infrastructure\Doctrine\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixtures extends Fixture
{
    private const array USERS = [
        [
            'uuid' => 'uuid-admin',
            'email' => 'admin@fake-mail.fr',
            'lastname' => 'admin-last-name',
            'firstname' => 'admin-first-name',
            'roles' => ['ROLE_ADMIN'],
            'password' => 'test',
        ],
        [
            'uuid' => 'uuid-cgp',
            'email' => 'cgp@fake-mail.fr',
            'lastname' => 'cgp-last-name',
            'firstname' => 'cgp-first-name',
            'roles' => ['ROLE_ADVISER'],
            'password' => 'testcgp',
        ],
        [
            'uuid' => 'uuid-cgp',
            'email' => 'mandat@fake-mail.fr',
            'lastname' => 'mandat-last-name',
            'firstname' => 'mandat-first-name',
            'roles' => ['ROLE_ADVISER_LIMITED'],
            'password' => 'testmandat',
        ],
        [
            'uuid' => 'uuid-external',
            'email' => 'external@fake-mail.fr',
            'lastname' => 'external-last-name',
            'firstname' => 'external-first-name',
            'roles' => ['ROLE_EXTERNAL'],
            'password' => 'testexternal',
        ],
    ];

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $user) {
            $entity = new User();
            $entity->uuid = $user['uuid'];
            $entity->email = $user['email'];
            $entity->lastName = $user['lastname'];
            $entity->firstName = $user['firstname'];
            $entity->roles = $user['roles'];
            $entity->password = $this->passwordHasher->hashPassword($entity, $user['password']);
            $this->setReference(User::class.'-'.$entity->email, $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
