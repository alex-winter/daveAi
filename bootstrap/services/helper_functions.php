<?php

function callAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

function maybe($input, $chance = 50): string
{
    return random_int(1, 100) <= $chance
        ? $input
        : '';
}

function pickRandom(array $options): string
{
    return $options[array_rand($options)];
}

/**
 * Goes through array of accepted phrases and will return any that appear in string
 *
 * @param array  $phrases
 * @param string $string
 *
 * @return bool
 */
function findPhraseInString(array $phrases, string $string): bool
{
   return (bool)array_filter($phrases, function (string $phrases) use ($string) {
       return strpos($string, $phrases) !== false;
   });
}
