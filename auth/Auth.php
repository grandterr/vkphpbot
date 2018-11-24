<?php

class Auth
{
    protected $user_id;
    protected $client_id = "6317971";
    protected $scope = "offline";
    protected $v = "5.69";
    protected $response_type = "code";
    protected $display = "page";
    protected $redirect_uri = "http://localhost/auth/";
    protected $client_secret = "epcmYni1OnbiO7r2gu63";


    function getAccessToken()
    {
        $request_params = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'code' => $_GET['code']
        );
        $get_params = http_build_query($request_params);
        $result = file_get_contents('https://oauth.vk.com/access_token?' . $get_params);
        return $rsult;
    }
}

?>

