<?php

declare(strict_types=1);

namespace App\Common\Command;

use App\Common\Service\Serializer;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

abstract class Command extends BaseCommand
{
    /**
     * @param OutputInterface $output
     * @param mixed $data
     * @param string $format
     */
    protected function printWithFormat(OutputInterface $output, $data, string $format = 'cli'): void
    {
        if ($format === 'cli') {
            $this->printWithCliFormat($output, $data);
            return;
        }

        $serializer = new Serializer();
        $result = $serializer->encode($data, $format);

        $output->writeln($result);
    }

    /**
     * @param OutputInterface $output
     * @param mixed $data
     */
    private function printWithCliFormat(OutputInterface $output, $data): void
    {
        try {
            $table = new Table($output);
            $table->setRows($this->fixResult($data));
            $table->render();
        } catch (Throwable $e) {
            if ($output instanceof ConsoleOutputInterface) {
                $message = "Data is not compatible with 'cli' format, it will use 'json' as fallback format";
                $output->getErrorOutput()->writeln("<comment>${message}</comment>");
            }
            $this->printWithFormat($output, $data, 'json');
        }
    }

    /**
     * @param mixed $result
     * @return mixed
     */
    private function fixResult($result)
    {
        if (is_array($result) && count($result) > 0 && !is_array($result[0])) {
            return array_map(
                fn($item) => ['data' => $item],
                $result
            );
        }

        return $result;
    }
}
