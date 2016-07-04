<?php
namespace User\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use User\Entity\User;
use User\Entity\LevelLogin;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        var_dump();
//        $level = new LevelLogin();$manager->find('\User\Entity\LevelLogin', 1)
//        echo $level->getLevel();
        $user = new User();
        $user->setLogin("Rafael.Viana");
        $user->setEmail("rafael@hotmail.com");
        $user->setRole($manager->find('Acl\Entity\Role', 1));


        $user->setPassword("1234");
        $user->setActive(true);

        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder() {
        return 100;
    }
}