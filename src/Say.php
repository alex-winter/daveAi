<?php

namespace DaveAI;

use DaveAI\Personality\Dave;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Migrations\Tools\Console\Command\AbstractCommand;

class Say extends AbstractCommand
{
    /** @var \DaveAI\Convosation\Say */
    protected $convosation;

    public function __construct(\DaveAI\Convosation\Say $say)
    {
        $this->convosation = $say;
        parent::__construct('dave');
    }

    protected function configure(): void
    {
        $this
            ->setName('dave')
            ->addOption('text', null, InputOption::VALUE_REQUIRED, 'Say something');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->convosation->giveInput($input->getOption('text'));
        $this->convosation->loadPersonality(new Dave());

        $output->writeln(implode(', ', $this->convosation->response()));
    }
}
