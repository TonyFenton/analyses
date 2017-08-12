<?php

namespace Tests\AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use AppBundle\Command\IncreaseAutoIncrementCommand;
use AppBundle\Entity\Matrix\Matrix;

class IncreaseAutoIncrementCommandTest extends KernelTestCase
{
    private $em = null;
    private $lastId = 0;

    public function __construct()
    {
        parent::__construct();
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    /**
     * require matrix table
     */
    public function testExecute()
    {
        $this->lastId = $this->insertRow();
        $this->checkExecute(2, 2);
        for ($i = 0; $i < 10; $i++) {
            $this->checkExecute(6, 8);
        }
    }

    private function insertRow(): int
    {
        $matrix = new Matrix();
        $this->em->persist($matrix);
        $this->em->flush();

        return $matrix->getId();
    }

    private function checkExecute(int $min, int $max)
    {
        $this->increaseAutoIncrement($min, $max);
        $low = $this->lastId + $min + 1;
        $high = $this->lastId + $max + 1;
        $id = $this->insertRow();
        $this->assertContains(
            $id,
            range($low, $high),
            "Result out of range. $id is not >= $low and <= $high. Arguments: min = $min, max = $max."
        );
        $this->lastId = $id;
    }

    private function increaseAutoIncrement(int $min, int $max)
    {
        $application = new Application(self::$kernel);
        $application->add(new IncreaseAutoIncrementCommand());
        $command = $application->find('app:increase-auto-increment');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'table' => 'matrix',
            'min' => $min,
            'max' => $max,
        ]);
        $output = $commandTester->getDisplay();
        $this->assertContains('Done.', $output, 'Wrong command output.');
    }
}