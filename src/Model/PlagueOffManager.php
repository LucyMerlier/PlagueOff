<?php

namespace App\Model;

use Symfony\Component\HttpClient\HttpClient;

/**
 * Class PlagueOffManager
 * Gets info from API
 */
class PlagueOffManager
{
    public const URL_VOICE =
    'http://api.voicerss.org/?key=b04eb53f930041159202b6b2405fe46f&hl=en-us&v=mike&f=48khz_16bit_stereo&c=MP3&src=';

    /**
     * Method getFoaasSentence
     * @param array $url
     * @return string
     */
    public static function getFoaasSentence(array $url): string
    {
        $client = HttpClient::create();

        $result = $client->request('GET', $url[rand(0, (count($url) - 1))], [
            'headers' => [
                'Accept' => 'text/plain',
            ],
        ]);

        return $result->getContent();
    }

    /**
     * Method getVoiceRssSound
     * @param string $content
     * @return string
     */
    public static function getVoiceRssSound(string $content): string
    {
        $client = HttpClient::create();

        $textToSpeechResponse = $client->request('GET', self::URL_VOICE . $content);

        return base64_encode($textToSpeechResponse->getContent());
    }

    public static function getDadJoke(string $url): string
    {
        $client = HttpClient::create();

        $request = $client->request('GET', $url);
        $result = $request->toArray();

        return $result['setup'] . " " . $result['punchline'];
    }

    public static function getCompliment(string $url): string
    {
        $client = HttpClient::create();

        $request = $client->request('GET', $url);
        $result = $request->toArray();

        return ucfirst($result['compliment']);
    }
}
