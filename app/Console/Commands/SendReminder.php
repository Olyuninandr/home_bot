<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $baseUrl = sprintf(
            "https://api.telegram.org/bot%s/",
            "5589626416:AAEa2YfY9Cp96p_-PI-w7LYMJ6oNx7Gs8gQ"
        );
        $guzzleClient = new Client(['base_uri' => $baseUrl]);

        $storage = file_get_contents(app_path() . "/Httpnames.txt");
        $storage = json_decode($storage, true);

        foreach ($storage as $userId => $userName) {
            $query = [
                'chat_id' => $userId,
                'text' => 'Ну шо, ты надумал?',
            ];
            try {
                $guzzleClient->post('sendMessage', ['query' => $query]);
            } catch (\Throwable $throwable) {

            }
        }
    }
}
