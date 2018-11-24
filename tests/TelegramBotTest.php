<?php
/**
 * Created by PhpStorm.
 * User: Dr.Raim
 * Date: 05-Jan-18
 * Time: 02:06
 */
require_once '../TelegramBot.php';
require_once '../Vk.php';

use PHPUnit\Framework\TestCase;

include '../vendor/autoload.php';

class TelegramBotTest extends TestCase
{

    public function testQuery()
    {
        $tg = new TelegramBot();
        $this->assertEquals('', $tg->query('sendMessage',
            [
                'text' => 1,
                'chat_id' => '169193039'
            ]));
    }

    public function testGetUpdates()
    {

    }

    public function testSendMessage()
    {
        $tg = new TelegramBot();
        $vk = new Vk();
        $this->assertEquals('h',
            $tg->sendMessage(169193039, 'h'));
    }
}
