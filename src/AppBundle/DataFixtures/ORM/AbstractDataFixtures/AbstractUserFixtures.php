<?php

namespace AppBundle\DataFixtures\ORM\AbstractDataFixtures;

use AppBundle\Entity\User;

abstract class AbstractUserFixtures extends AbstractDataFixtures
{
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
        $this->addReference('user_'.$this->refCounter, $user);
        $this->refCounter++;

        return $this;
    }

    public function getOrder(): int
    {
        return 10;
    }
}