<?php

namespace DaveAI\Personality;

interface PersonalityInterface
{
    // actions
    public function getReactionToWeather($weather): string;

    // response to text
    public function confusedResponse(string $input): string;
    public function surprisedResponse(string $input): string;
    public function angryResponse(string $input): string;
    public function positiveResponse(string $input): string;
    public function greeting(string $input): string;
}
