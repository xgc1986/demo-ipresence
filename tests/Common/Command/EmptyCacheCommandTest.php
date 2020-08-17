<?php

declare(strict_types=1);

namespace App\Tests\Common\Command;

use App\Common\Command\EmptyCacheCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class EmptyCacheCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find(EmptyCacheCommand::getDefaultName());
        $commandTester = new CommandTester($command);
        $commandTester->setInputs(['author_0', 2, 'json']);
        $commandTester->execute([]);
        $this->assertEquals(0, $commandTester->getStatusCode());
    }
}
