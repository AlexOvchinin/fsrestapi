<?php

namespace Fsrestapi\Api\Controllers;

trait AuthTrait
{
    public function checkAuth($request)
    {
        $auth = $request->get('Authorization');
        if (!is_string($auth))
            return false;

        $authArray = explode(' ', $auth);
        if (count($authArray) != 2)
            return false;

        $credentials = $authArray[1];
        if (!is_string($credentials))
            return false;

        $credentialsArray = explode(':', base64_decode($credentials));
        if (count($credentialsArray) != 2)
            return false;

        $username = $credentialsArray[0];
        $password = $credentialsArray[1];

        $user = \Users::findFirst(
            array(
                "username = :username: AND password = :password:",
                'bind' => array(
                    'username'    => $username,
                    'password' => $password
                )
            )
        );

        return $user != false;
    }
}