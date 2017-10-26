<?php

namespace DaveAI\Conversation;

use DaveAI\Action\Weather\Weather;
use DaveAI\Personality\PersonalityInterface;

class Conversation
{
    const ACCEPTED_GREETINGS = [
        'hi',
        'hello',
        'alright',
        'how',
        'are',
        'doing',
        'ya',
        'you',
    ];

    protected $input;

    /** @var PersonalityInterface */
    protected $personality;

    /** @var Weather */
    protected $weather;

    public function __construct(Weather $weather)
    {
        $this->weather = $weather;
    }

    public function loadPersonality(PersonalityInterface $personality): void
    {
        $this->personality = $personality;
    }

    public function giveInput(string $input): void
    {
        $this->input = $input;
    }

    public function getResponse(): string
    {
        $weather = [
            'whats the weather like in',
            'weather in',
            'weather today in',
            'weather '
        ];

        $responseText     = [];
        $input            = $this->input;
        $understand       = false;
        $matchesAGreeting = findPhraseInString(static::ACCEPTED_GREETINGS, $input);
        $askForWeather    = findPhraseInString($weather, $input);

        if ($matchesAGreeting) {
            $responseText[] = $this->personality->greeting($input);
            $understand     = true;
        }

        if ($askForWeather) {
            $words          = explode(' ', $input);
            $cityId         = $this->weather->getCityId($words);
            $weather        = callAPI('GET', 'http://samples.openweathermap.org/data/2.5/weather?id=' . $cityId . '&appid=b1b15e88fa797225412429c1c50c122a1');
            $weather        = json_decode($weather);
            $responseText[] = $this->personality->getReactionToWeather($weather);
            $understand     = true;
        }

        if (!$understand) {
            $responseText = [
                $this->personality->confusedResponse($input)
            ];
        }

        return implode(', ', $responseText);
    }
}
