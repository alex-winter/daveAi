<?php

namespace DaveAI\Convosation;

class Say
{
    protected $input;

    protected $confusedResponses = [
        'you what',
        'what',
        'uh',
        'u wot',
        'you havin me on',
    ];

    public function __construct(string $input)
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

        $responseText = [];
        $say          = $this->input;
        $understand   = false;

        if (strpos(implode('', $greetings), $say) !== false) {
            $responseText[] = $greetings[array_rand($greetings)];
            $understand     = true;
        }

        if (strpos($say, 'strongbow') !== false) {
            $responseText[] = 'strongbow?, yeah mate Ill have one';
            $understand     = true;
        }

        $askForWeather = array_filter($actions['weather'], function (string $term) use ($say) {
                return strpos($term, $say) !== false;
            }) !== false;

        if ($askForWeather) {
            $words          = explode(' ', $say);
            $cityId         = $this->getCityId($words);
            $weather        = $this->callAPI('GET', 'http://samples.openweathermap.org/data/2.5/weather?id=' . $cityId . '&appid=b1b15e88fa797225412429c1c50c122a1');
            $weather        = json_decode($weather);
            $responseText[] = $this->getReactionToWeather($weather);
            $understand     = true;
        }

        if (!$understand) {
            $responseText = [
                $this->confusedResponse($say)
            ];
        }

        return $responseText;
    }
}
