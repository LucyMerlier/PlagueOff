<?php

namespace App\Controller;

use App\Model\PlagueOffManager;

/**
 * Class PlagueOffController
 * Displays pages
 */
class PlagueOffController extends AbstractController
{
    public const API_ERROR = "";

    /**
     * Method home()
     * Generates random phrase and displays home page
     * @return string
     */
    public function home(): string
    {
        $content = '';
        $voiceMessage = '';

        // Check if POST is OK
        if (!empty($_POST['userName']) && !empty($_POST['asshole'])) {
            if (!empty($_POST['hardFuckOff'])) {
                if ($_POST['hardFuckOff'] === 'Tell them to fuck right off') {
                    $userName = ucfirst(trim($_POST['userName']));
                    $assholeName = ucfirst(trim($_POST['asshole']));

                    // links to API results
                    $apiUrls = [
                        'https://www.foaas.com/back/' . $assholeName . '/' . $userName,
                        'https://www.foaas.com/shakespeare/' . $assholeName . '/' . $userName,
                        'https://www.foaas.com/chainsaw/' . $assholeName . '/' . $userName,
                        'https://www.foaas.com/horse/' . $userName,
                        'https://www.foaas.com/caniuse/a%20mask/' . $userName,
                        'https://www.foaas.com/question/' . $userName,
                        'https://www.foaas.com/caniuse/soap%20when%20you%20wash%20your%20hands/' . $userName,
                        'https://www.foaas.com/yoda/' . $assholeName . '/' . $userName
                    ];

                    // Not checking if they return API_ERROR because meh
                    $content = str_replace(' - ', ' Respectfully, ', PlagueOffManager::getFoaasSentence($apiUrls));
                    $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
                }
            } elseif (!empty($_POST['mediumFuckOff'])) {
                if ($_POST['mediumFuckOff'] === 'Tell a joke, then tell them to back off') {
                    $userName = ucfirst(trim($_POST['userName']));

                    // Link to API result
                    $apiUrl = 'https://official-joke-api.appspot.com/random_joke';

                    // Not checking if they return API_ERROR because meh
                    $content = PlagueOffManager::getJoke($apiUrl) .
                    " Now that we had a good laugh, back off. Best regards, " . $userName;
                    $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
                }
            } elseif (!empty($_POST['lightFuckOff'])) {
                if ($_POST['lightFuckOff'] === 'Gently ask them to back away') {
                    $userName = ucfirst(trim($_POST['userName']));

                    // Link to API result
                    $apiUrl = 'https://complimentr.com/api';

                    // Not checking if they return API_ERROR because meh
                    $content = PlagueOffManager::getCompliment($apiUrl) .
                    ", but please, don't stay too close. Thank you, " . $userName;
                    $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
                }
            }
        }


        return $this->twig->render(
            'PlagueOff/home.html.twig',
            ['message' => $content, 'voiceMessage' => $voiceMessage]
        );
    }

    /**
     * Method info()
     * Displays a page that gives information on how to avoid the plague
     * @return string
     */
    public function info()
    {
        return $this->twig->render('PlagueOff/info.html.twig');
    }
}
