<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class IncreaseAutoIncrementCommand extends ContainerAwareCommand
{
    private $em = null;
    private $table = '';
    private $min = 0;
    private $max = 0;

    protected function configure()
    {
        $this
            ->setName('app:increase-auto-increment')
            ->setDescription('Increase the auto increment of a table.')
            ->addArgument('table', InputArgument::REQUIRED, 'The table name')
            ->addArgument('min', InputArgument::REQUIRED, 'The min value for increasing')
            ->addArgument('max', InputArgument::REQUIRED, 'The max value for increasing');

    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);
        $this->table = $input->getArgument('table');
        $this->min = $input->getArgument('min');
        $this->max = $input->getArgument('max');

        $newAutoIncrement = $this->getAutoIncrement() + mt_rand($this->min, $this->max);
        $msg = $this->setAutoIncrement($newAutoIncrement);

        $output->write($msg.' Time: '.round((microtime(true) - $startTime), 2).' seconds.');
    }

    private function getAutoIncrement(): int
    {
        $sql = "SELECT AUTO_INCREMENT
                FROM INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = :table";
        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute(['table' => $this->table]);

        return $stmt->fetch()['AUTO_INCREMENT'];
    }

    private function setAutoIncrement(int $autoIncrement): string
    {
        $sql = "ALTER TABLE {$this->table} AUTO_INCREMENT = $autoIncrement";
        $stmt = $this->em->getConnection()->prepare($sql);
        if ($stmt->execute() === true) {
            $msg = 'Done.';
        } else {
            $msg = print_r($stmt->errorInfo(), true);
        }

        return $msg;
    }
}