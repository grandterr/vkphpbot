<?php

use GuzzleHttp\Client;

class Vk
{
    protected $user_id;
    protected $client_id = "6317971";
    protected $scope = "offline";
    protected $v = "5.69";
    protected $response_type = "code";
    protected $display = "page";
    protected $redirect_uri = "http://localhost/app/vk/";
    protected $client_secret = "epcmYni1OnbiO7r2gu63";
    protected $code;

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    public function query($method, $params = [])
    {
        $url = "https://api.telegram.org/bot";

        $url .= "/" . $method;

        if (!empty($params)) {
            $url .= "?" . http_build_query($params);
        }
        $client = new Client(
            ['base_uri' => $url]
        );

        $result = $client->request('GET');

        return json_decode($result->getBody());
    }

    public function getCodeAndAccessToken()
    {
        $request_params = array(
            'client_id' => $this->client_id,
            'display' => $this->display,
            'redirect_uri' => $this->redirect_uri,
            'scope' => $this->scope,
            'response_type' => $this->response_type,
            'v' => $this->v
        );
        $get_params = http_build_query($request_params);
        $code = file_get_contents('https://oauth.vk.com/authorize?' . $get_params);
        return $code;
    }

    public function getUserInfo()
    {
        $request_params = array('user_ids' => $this->user_id);
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://api.vk.com/method/users.get?' . $get_params);
        return $result;
    }

    public function getSubscriptions()
    {
        $request_params = array('user_id' => $this->user_id);
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://api.vk.com/method/users.getSubscriptions?' . $get_params);
        return $result;
    }

    public function getFollowers()
    {
        $request_params = array('user_ids' => $this->user_id);
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://api.vk.com/method/getFollowers?' . $get_params);
        return $result;
    }

    public function getGroups()
    {
        $request_params = array('user_ids' => $this->user_id);
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://api.vk.com/method/groups.get?' . $get_params);
        return $result;
    }

    public function getFriends()
    {
        $request_params = array('user_id' => $this->user_id);
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://api.vk.com/method/friends.get?' . $get_params);
        return $result;
    }
}

//https://oauth.vk.com/access_token?client_id=1&client_secret=H&redirect_uri=http://mysite.ru&code=
?>



