<?php

declare(strict_types=1);

namespace App\Demo\IO\Command;

use App\Demo\Application\Query\GetShouts;
use App\Demo\Application\Service\Bus;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class DemoShoutsListCommand extends DemoCommand
{
    protected static $defaultName = 'demo:shouts:list';

    private Bus $bus;

    public function __construct(Bus $bus)
    {
        parent::__construct();
        $this->bus = $bus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $author = $this->askForAuthor($input, $output);
        $limit = $this->askForLimit($input, $output);
        $format = $this->askForFormat($input, $output);

        $result = $this->bus->dispatchQuery(new GetShouts($author, $limit));

        $this->printWithFormat($output, $result->serialize(), $format);

        return 0;
    }

    private function askForAuthor(InputInterface $input, OutputInterface $output): string
    {
        $helper = $this->getHelper('question');
        $question = new Question('Author:');

        return $helper->ask($input, $output, $question);
    }

    private function askForLimit(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new Question('Maximum quotes (> 0 and <= 10):');

        return (int)$helper->ask($input, $output, $question);
    }

    private function askForFormat(InputInterface $input, OutputInterface $output): string
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Format: [<comment>cli</comment>]',
            ['cli', 'json', 'csv', 'xml', 'yaml'],
            'cli'
        );

        return $helper->ask($input, $output, $question);
    }
}
