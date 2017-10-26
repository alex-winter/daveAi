<?php

namespace DaveAI\Personality;

class Robot implements PersonalityInterface
{
    public function greeting(string $input): string
    {
        return 'hello';
    }

    public function getReactionToWeather($weather): string
    {

        var_dump($weather);
        return 'Here is your weather';
    }

    public function confusedResponse(string $input): string
    {
        return 'Error, does not compute';
    }

    public function positiveResponse(string $input): string
    {
        return '';
    }

    public function surprisedResponse(string $input): string
    {
        return '';
    }

    public function angryResponse(string $input): string
    {
        return 'Anger Initialised >:(';
    }
}
