<?php
/**
 * Created by PhpStorm.
 * User: Dr.Raim
 * Date: 05-Jan-18
 * Time: 01:45
 */
require_once '../Vk.php';

use PHPUnit\Framework\TestCase;

class VkTest extends TestCase
{
    public function testgetUserInfo()
    {
        $vk = new Vk();
        $vk->setUserId(1);
        $this->assertEquals('{"response":[{"uid":1,"first_name":"Павел","last_name":"Дуров"}]}', $vk->getUserInfo());
    }

    public function testgetGroups()
    {
        $vk = new Vk();
        $vk->setUserId(1);
        $this->assertEquals('{"error":{"error_code":5,"error_msg":"User authorization failed: no access_token passed.","request_params":[{"key":"oauth","value":"1"},{"key":"method","value":"groups.get"},{"key":"user_ids","value":"1"}]}}', $vk->getGroups());
    }

    public function testgetFriends()
    {
        $vk = new Vk();
        $vk->setUserId(1);
        $this->assertEquals('{"response":[]}', $vk->getFriends());
    }

    public function testgetFollowers()
    {
        $vk = new Vk();
        $vk->setUserId(1);
        $this->assertEquals('{"error":{"error_code":5,"error_msg":"User authorization failed: no access_token passed.","request_params":[{"key":"oauth","value":"1"},{"key":"method","value":"getFollowers"},{"key":"user_ids","value":"1"}]}}', $vk->getFollowers());
    }

    public function testgetSubscriptions()
    {
        $vk = new Vk();
        $vk->setUserId(1);
        $this->assertEquals('{"response":{"users":{"count":0,"items":[]},"groups":{"count":0,"items":[]}}}', $vk->getSubscriptions());
    }
}