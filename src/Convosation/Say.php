<?php

namespace DaveAI\Convosation;

use DaveAI\Action\Weather\Weather;
use DaveAI\Personality\PersonalityInterface;

class Say
{
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

    public function response(): array
    {
        $greetings = [
            'hi',
            'hello',
            'alright',
            'how',
            'are',
            'doing',
            'ya',
            'you',
        ];

        $weather = [
            'whats the weather like in',
            'weather in',
            'weather today in',
            'weather '
        ];

        $responseText     = [];
        $say              = $this->input;
        $understand       = false;
        $matchesAGreeting = findPhraseInString($greetings, $say);
        $askForWeather    = findPhraseInString($weather, $say);

        if ($matchesAGreeting) {
            $responseText[] = $this->personality->greeting($say);
            $understand     = true;
        }

        if ($askForWeather) {
            $words          = explode(' ', $say);
            $cityId         = $this->weather->getCityId($words);
            $weather        = callAPI('GET', 'http://samples.openweathermap.org/data/2.5/weather?id=' . $cityId . '&appid=b1b15e88fa797225412429c1c50c122a1');
            $weather        = json_decode($weather);
            $responseText[] = $this->personality->getReactionToWeather($weather);
            $understand     = true;
        }

        if (!$understand) {
            $responseText = [
                $this->personality->confusedResponse($say)
            ];
        }

        return $responseText;
    }
}
