<?php

$app['personality.dave'] = function () {
    return new \DaveAI\Personality\Dave();
};

$app['personality.robot'] = function () {
    return new \DaveAI\Personality\Robot();
};
