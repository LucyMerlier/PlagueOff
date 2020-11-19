<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

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
        $content = "";

        if (!empty($_POST['userName']) && !empty($_POST['asshole'])) {
            $userName = ucfirst(trim($_POST['userName']));
            $assholeName = ucfirst(trim($_POST['asshole']));

            $client =  HttpClient::create();
            $apiUrls = [
                'https://www.foaas.com/asshole/' . $userName,
                'https://www.foaas.com/cool/' . $userName,
                'https://www.foaas.com/cup/' . $userName,
                'https://www.foaas.com/back/' . $assholeName . '/' . $userName,
                'https://www.foaas.com/blackadder/' . $assholeName . '/' . $userName,
                'https://www.foaas.com/horse/' . $userName,
                'https://www.foaas.com/caniuse/a%20mask/' . $userName,
                'https://www.foaas.com/yoda/' . $assholeName . '/' . $userName
            ];

            $result = $client->request('GET', $apiUrls[rand(0, (count($apiUrls) - 1))], [
                'headers' => [
                    'Accept' => 'text/plain',
                ],
            ]);

            $content = $result->getContent();
        }

        return $this->twig->render('PlagueOff/home.html.twig', ['message' => $content]);
    }
}
