<?php

namespace DaveAI\Action\Weather;

class Weather
{
    protected $triggers = [
        'whats the weather today',
        'whats the weather like',
        'weather in'
    ];

    public function getCityId(array $words):? int
    {
        $cities = include __DIR__ . '/../../bootstrap/cities.php';

        $filter = array_filter($cities, function ($city) use ($words) {
            return in_array($city->name, $words);
        });

        $city = array_shift(
            $filter
        );

        return $city->id;
    }
}
