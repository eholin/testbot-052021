<?php


namespace botexample;

/**
 * Class BotApi
 * @package botexample
 */
class BotApi
{

    private $chat_id;

    const BOT_TOKEN = '';
    const TELEGRAM_API_BASE_URL = 'https://api.telegram.org/bot';

    public function __construct($chat_id)
    {
        if (!$chat_id) {
            throw new \Exception('Не задан ID чата Telegram');
        }

        $this->chat_id = $chat_id;
    }

    /**
     * @param $message
     * @return bool|string
     * @throws \Exception
     */
    public function sendMessage($message)
    {
        if (!self::BOT_TOKEN) {
            throw new \Exception('Отсутствует токен');
        }

        if (!$message) {
            throw new \Exception('Не задан текст сообщения');
        }

        $url = self::TELEGRAM_API_BASE_URL . self::BOT_TOKEN . '/sendMessage';
        $params = array(
            'chat_id' => $this->chat_id,
            'text' => $message,
            'parse_mode' => 'HTML',
        );

        try {
            $query = new RemoteQuery($url);
            return $query->postQuery($params);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
