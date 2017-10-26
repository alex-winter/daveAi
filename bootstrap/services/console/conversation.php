<?php

use Pimple\Container;

$app['conversation'] = function (Container $container) {
    return new \DaveAI\Conversation\Conversation(
        new DaveAI\Action\Weather\Weather()
    );
};
