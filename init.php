<?php
include 'vendor/autoload.php';
include 'Telegrambot.php';
include 'Vk.php';

$telegramApi = new TelegramBot();
$vkApi = new Vk();


while (true) {
    sleep(2);

    $updates = $telegramApi->getUpdates();
    print_r($updates);
    foreach ($updates as $update) {
        if (preg_match('/(\/new|\/start)/', $update->message->text)) {
            print $update->message->chat->id;
            $msg = $telegramApi->sendMessage($update->message->chat->id, 'Введите ID (только номер id). Пример 74477317');
            print_r($msg);
        }
        if (preg_match('/\d/', $update->message->text)) {
            $vkApi->setUserId($update->message->text);
            $telegramApi->sendMessage($update->message->chat->id, 'Какие данные вам выдать?
                /profile
                /friends
                /groups
                /followers
                /subscriptions');
        }
        if (!empty($vkApi->getUserId())) {
            $telegramApi->sendMessage($update->message->chat->id, 'Выберите что-нибудь из списка (для предыдуще выбранного id)
                    ИЛИ Введите новый id /new:
                    /profile
                    /friends
                    /groups
                    /followers
                    /subscriptions');
            switch ($update->message->text) {
                case (preg_match('/\/profile/', $update->message->text) ? true : false):
                    echo $vkApi->getUserInfo();
                    $telegramApi->sendMessage($update->message->chat->id, $vkApi->getUserInfo());
                    break;
                case (preg_match('/\/friends/', $update->message->text) ? true : false):
                    $telegramApi->sendMessage($update->message->chat->id, $vkApi->getFriends());
                    break;
                case (preg_match('/\/followers/', $update->message->text) ? true : false):
                    $telegramApi->sendMessage($update->message->chat->id, $vkApi->getFollowers());
                    break;
                case (preg_match('/\/subscriptions/', $update->message->text) ? true : false):
                    $telegramApi->sendMessage($update->message->chat->id, $vkApi->getSubscriptions());
                    break;
                case (preg_match('/\/groups/', $update->message->text) ? true : false):
                    $telegramApi->sendMessage($update->message->chat->id, 'Для этого требуется авторизация:
                    https://oauth.vk.com/authorize?client_id=6317971&display=page&redirect_uri=https://t.me/@KFUItisBot&scope=friends&response_type=code&v=5.69);');
                    $telegramApi->sendMessage($update->message->chat->id, $vkApi->getGroups());
                    break;
                default:
                    break;
            }
        }
    }
}

//74477317
?>