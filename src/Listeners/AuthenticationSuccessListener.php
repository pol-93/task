<?php

namespace App\Listeners;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Cookie;


class AuthenticationSuccessListener
{

    private $secure = false;
    private $tokenttl;

    public function __construct($tokenttl)
    {
        $this->tokenttl = $tokenttl;
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $response = $event->getResponse();
        $data = $event->getData();
        $token = $data['token'];
        //unset($data['token']);
        //unset($data['refresh_token']);
        //$event->setData($data);
        $response->headers->setcookie(
            new Cookie("BEARER",$token, (
                new \DateTime())
                    ->add(new \DateInterval('PT' . $this->tokenttl . 'S'))
            , '/', null, $this->secure));
    }


}