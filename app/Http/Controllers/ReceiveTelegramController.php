<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ReceiveTelegramController extends Controller
{
    public function receive(Request $request)
    {
        $baseUrl = sprintf(
            "https://api.telegram.org/bot%s/",
            "5589626416:AAEa2YfY9Cp96p_-PI-w7LYMJ6oNx7Gs8gQ"
        );
        $guzzleClient = new Client(['base_uri' => $baseUrl]);

        $userId = $request->request->get('message')['from']['id'] ?? null;
        $userName = sprintf(
            '%s %s',
            $request->request->get('message')['from']['first_name'],
            $request->request->get('message')['from']['last_name']
        ) ?? null;

        if (is_null($userId) || is_null($userName)) {
            return;
        }

        $message = sprintf(
            '%s, заебал, давай бухать',
            $userName,
        );

        $query = [
            'chat_id' => $userId,
            'text' => $message,
        ];

        $guzzleClient->post('sendMessage', ['query' => $query]);

        $storage = file_get_contents(dirname(__DIR__). 'names.txt');
        $storage = json_decode($storage, true) ?? [];

        if (!array_key_exists($userId, $storage)) {
            $storage[$userId] = $userName;
            file_put_contents(dirname(__DIR__). 'names.txt', json_encode($storage));
        }
    }
}
