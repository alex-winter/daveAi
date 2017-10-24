<?php

namespace DaveAI\Personality;

class Dave implements PersonalityInterface
{
    public function getReactionToWeather($weather)
    {
        $reactionToWeather = [
            'Clouds' => [
                'no sunshine today by looks of it',
                'cloudy as fuck',
                'nothing but bloody clouds',
                'fuckin grey out there',
            ]
        ];

        $text  = '';
        $text .= $this->pickRandom($reactionToWeather[$weather->weather[0]->main]) . $this->maybe(' fuuuckin hell');

        if ($weather->wind->speed > 40) {
            $text .= ' fuuuckin hell, windy as fuck out there';
        } else if ($weather->wind->speed > 10) {
            $text .= ' bit blowy as well' . $this->maybe(' mate');
        }

        return $text;
    }

    public function confusedResponse(string $input)
    {
        $response = '';

        if (strlen($input) < 30) {
            $response = $input . '?? ';
        }

        $response .= $this->pickRandom($this->confusedResponses) . $this->maybe(' mate') . '?';

        return $response;
    }
}
