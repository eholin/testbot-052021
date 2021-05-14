<?php

namespace botexample\BotCommands;

use botexample\BotApi;
use botexample\BotInterface;
use botexample\LeadsData\GetUserAPI;

/**
 * Class GetUser
 * @package botexample\BotCommands
 */
class GetUser extends BotApi implements BotInterface
{

    /**
     * @throws \Exception
     */
    public function sendAnswer()
    {
        $user = new GetUserAPI();

        $message = 'ID: ' . $user->getUserID() . ', имя: ' . $user->getUserName();

        $this->sendMessage($message);
    }
}
