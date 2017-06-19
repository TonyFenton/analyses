<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\User;

abstract class AbstractUserFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    private $userRefCounter = 0;
    protected $em = null;

    protected function setUser(
        string $name,
        string $email,
        string $password,
        bool $isEnabled = true
    ): AbstractUserFixtures {
        $user = new User();
        $user->setUsername($name);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled($isEnabled);

        $this->em->persist($user);
        $this->addReference('user_'.$this->userRefCounter, $user);
        $this->userRefCounter++;

        return $this;
    }

    public function getOrder()
    {
        return 10;
    }
}