<?php

use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Input\InputOption;

$app = new \Cilex\Application('Dave AI', '1.0.0');

/**
 * Recursively load all php files.
 *
 * @param string $root
 */
$load = function ($root) use (&$load, &$app, &$container) {
    $extension = 'php';
    foreach (glob($root . '/*') as $path) {
        if (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === $extension) {
            /** @noinspection PhpIncludeInspection */
            require_once $path;
        } elseif (is_dir($path)) {
            $load($path);
        }
    }
};

$load(__DIR__ . '/services');

/** Package Tools */
$personalities = array_filter($app->keys(), function ($item) {
    return strpos($item, 'personality') !== false;
});


/**
 * Create a new command for each personality
 */
foreach ($personalities as $personality) {
    /** @var \DaveAI\Conversation\Conversation $conversation */
    $conversation = clone $app['conversation'];
    $conversation->loadPersonality($app[$personality]);

    $personalityCommand = explode('.', $personality)[1];

    $app->command(
        $personalityCommand,
        function (Input $input, Output $output) use ($conversation) {
            $conversation->giveInput($input->getOption('text'));
            $output->writeln($conversation->getResponse());
        }
    )->addOption(
        'text',
        null,
        InputOption::VALUE_REQUIRED,
        'Say something'
    );
}

return $app;
