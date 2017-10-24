<?php

namespace DaveAI\Personality;

interface PersonalityInterface
{
    // actions
    public function getReactionToWeather(): string;

    // response to text
    public function confusedResponse(): string;
    public function surprisedResponse(): string;
    public function angryResponse(): string;
    public function positiveResponse(): string;
}
