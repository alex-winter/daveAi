<?php

use Pimple\Container;

$app[\DaveAI\Say::class] = function (Container $container) {
    return new \DaveAI\Say(
        $container[\DaveAI\Convosation\Say::class]
    );
};

$app[\DaveAI\Convosation\Say::class] = function (Container $container) {
    return new \DaveAI\Convosation\Say(
        new DaveAI\Action\Weather\Weather()
    );
};
