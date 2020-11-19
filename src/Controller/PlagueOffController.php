<?php

namespace App\Controller;

use App\Model\PlagueOffManager;

/**
 * Class PlagueOffController
 * Displays pages
 */
class PlagueOffController extends AbstractController
{
    /**
     * Method home()
     * Generates random phrase and displays home page
     * @return string
     */
    public function home(): string
    {
        $content = '';
        $voiceMessage = '';

        if (!empty($_POST['hardFuckOff']) && !empty($_POST['userName']) && !empty($_POST['asshole'])) {
            $userName = ucfirst(trim($_POST['userName']));
            $assholeName = ucfirst(trim($_POST['asshole']));

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

            $content = str_replace(' - ', ' Respectfully, ', PlagueOffManager::getFoaasSentence($apiUrls));
            $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
        } elseif (!empty($_POST['mediumFuckOff'])) {
            $apiUrl = 'https://official-joke-api.appspot.com/random_joke';

            $content = PlagueOffManager::getDadJoke($apiUrl) . " Now that we had a good laugh, back off.";
            $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
        } elseif (!empty($_POST['lightFuckOff'])) {
            $apiUrl = 'https://complimentr.com/api';

            $content = PlagueOffManager::getCompliment($apiUrl) . ". Now, please, back off.";
            $voiceMessage = PlagueOffManager::getVoiceRssSound(urlencode($content));
        }

        return $this->twig->render(
            'PlagueOff/home.html.twig',
            ['message' => $content, 'voiceMessage' => $voiceMessage]
        );
    }

    public function info()
    {
        return $this->twig->render('PlagueOff/info.html.twig');
    }
}
