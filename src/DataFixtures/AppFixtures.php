<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\User;
use App\Repository\BlogRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@yandex.ru');
        $user->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($user, 'admin@yandex.ru');
        $user->setPassword($password);
        $manager->persist($user);

        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@yandex.ru');
            $password = $this->hasher->hashPassword($user, 'pass_1234');
            $user->setPassword($password);
            $manager->persist($user);

            for ($j = 0; $j < 100; $j++) {
                $blog = new Blog($user);
                $blog->setTitle('Blog title' . $j)
                    ->setDescription('Blog description' . $j)
                    ->setText('Blog text' . $j);
                $manager->persist($blog);
            }
        }

        $manager->flush();
    }
}
