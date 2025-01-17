<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordEncoder)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        $user = new Admin();
        $user
            ->setEmail('admin@positron-it.ru')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword(
                $this->passwordEncoder->hashPassword(
                    $user,
                    'symD3V'
                )
            );
        $manager->persist($user);

        $manager->flush();
    }
}
