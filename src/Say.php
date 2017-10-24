<?php

namespace DaveAI;

use Cilex\Provider\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Say extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('dave')
            ->addOption('text', null, InputOption::VALUE_REQUIRED, 'Say something');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $dave = new \DaveAI\Convosation\Say($input->getOption('text'));

        $output->writeln(implode(', ', $dave->response()));
    }
}
