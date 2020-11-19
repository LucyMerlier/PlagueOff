<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Class PlagueOffManager
 * Gets info from API
 */
class PlagueOffManager
{
    public const API_ERROR = "";
    public const URL_VOICE =
    'http://api.voicerss.org/?key=b04eb53f930041159202b6b2405fe46f&hl=en-us&v=mike&f=48khz_16bit_stereo&c=MP3&src=';

    /**
     * Method getFoaasSentence
     * Uses API https://www.foaas.com
     * Gets random offensive phrase
     * @param array $url
     * @return string
     */
    public static function getFoaasSentence(array $url): string
    {
        try {
            $client = HttpClient::create();

            $request = $client->request('GET', $url[rand(0, (count($url) - 1))], [
                'headers' => [
                    'Accept' => 'text/plain',
                ],
            ]);

            if ($request->getStatusCode() === 200) {
                $result = $request->getContent();
            } else {
                return self::API_ERROR;
            }
        } catch (\Exception $e) {
            return self::API_ERROR;
        }

        return $result;
    }

    /**
     * Method getVoiceRssSound
     * Uses API http://api.voicerss.org
     * Text to voice
     * @param string $content
     * @return string
     */
    public static function getVoiceRssSound(string $content): string
    {
        try {
            $client = HttpClient::create();

            $textToSpeechResponse = $client->request('GET', self::URL_VOICE . $content);

            if ($textToSpeechResponse->getStatusCode() === 200) {
                $result = base64_encode($textToSpeechResponse->getContent());
            } else {
                return self::API_ERROR;
            }
        } catch (\Exception $e) {
            return self::API_ERROR;
        }

        return $result;
    }

    /**
     * Method getJoke
     * Uses API https://official-joke-api.appspot.com
     * Gets random joke
     * @param string  $url
     * @return string
     */
    public static function getJoke(string $url): string
    {
        try {
            $client = HttpClient::create();

            $request = $client->request('GET', $url);

            if ($request->getStatusCode() === 200) {
                $result = $request->toArray();
            } else {
                return self::API_ERROR;
            }
        } catch (\Exception $e) {
            return self::API_ERROR;
        }

        return $result['setup'] . " " . $result['punchline'];
    }

    /**
     * Method getCompliment
     * Uses API https://complimentr.com/api
     * Gets random compliment
     * @param string $url
     * @return string
     */
    public static function getCompliment(string $url): string
    {
        try {
            $client = HttpClient::create();

            $request = $client->request('GET', $url);

            if ($request->getStatusCode() === 200) {
                $result = $request->toArray();
            } else {
                return self::API_ERROR;
            }
        } catch (\Exception $e) {
            return self::API_ERROR;
        }

        return ucfirst($result['compliment']);
    }
}
