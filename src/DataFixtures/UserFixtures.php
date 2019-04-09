<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("user@fixture.fr");
        $user->setPassword($this->passwordEncoder->encodePassword($user, "user"));
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail("admin@fixture.fr");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, "admin"));
        $manager->persist($admin);

        $createur = new User();
        $createur->setEmail("createur@fixture.fr");
        $createur->setRoles(['ROLE_CREATEUR']);
        $createur->setPassword($this->passwordEncoder->encodePassword($createur,"createur"));
        $manager->persist($createur);

        $manager->flush();
    }
}
