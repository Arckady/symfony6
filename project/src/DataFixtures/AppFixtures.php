<?php

namespace App\DataFixtures;

use App\Entity\Admin;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        $user = new Admin();
        $user
            ->setEmail('admin@positron-it.ru')
            ->setRoles(array("ROLE_ADMIN"))
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