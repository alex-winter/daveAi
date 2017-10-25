<?php

namespace DaveAI\Personality;

class Dave implements PersonalityInterface
{
    protected $greetings = [
        'hi',
        'alright?'
    ];

    protected $confusedResponses = [
        'you what',
        'what',
        'uh',
        'u wot',
        'you havin me on',
    ];

    protected $weatherResponses = [
        'main'       => [
            'Clouds' => [
                'no sunshine today by looks of it',
                'cloudy as fuck',
                'nothing but bloody clouds',
                'fuckin grey out there',
            ],
        ],
        'wind_speed' => [
            40 => [
                'fuuuckin hell, windy as fuck out there'
            ],
            10 => [
                'bit blowy as well'
            ],
        ]
    ];

    public function getReactionToWeather($weather): string
    {
        $text = '';
        $text .= pickRandom($this->weatherResponses['main'][$weather->weather[0]->main]) . maybe(' fuuuckin hell');
        $text .= ' ';

        $responseToWind = '';

        foreach ($this->weatherResponses['wind_speed'] as $windSpeed => $responses) {
            if ($weather->wind->speed >= $windSpeed) {
                $responseToWind = pickRandom($responses) . maybe(' mate');
            }
        }

        $text .= $responseToWind;

        return $text;
    }

    public function confusedResponse(string $input): string
    {
        $response = '';

        if (strlen($input) < 30) {
            $response = $input . '?? ';
        }

        $response .= pickRandom($this->confusedResponses) . maybe(' mate') . '?';

        return $response;
    }

    public function angryResponse(string $input): string
    {
        // TODO: Implement angryResponse() method.
    }

    public function surprisedResponse(string $input): string
    {
        // TODO: Implement surprisedResponse() method.
    }

    public function positiveResponse(string $input): string
    {
        // TODO: Implement positiveResponse() method.
    }

    public function greeting(string $input): string
    {
        return pickRandom($this->greetings);
    }
}
