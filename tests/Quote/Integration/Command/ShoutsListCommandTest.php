<?php

declare(strict_types=1);

namespace App\Tests\Demo\Integration\Command;

use App\Quote\IO\Command\ShoutsListCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ShoutsListCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find(ShoutsListCommand::getDefaultName());
        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['author 0', 2, 'json']);
        $commandTester->execute([]);
        $this->assertEquals(0, $commandTester->getStatusCode());
    }
}
