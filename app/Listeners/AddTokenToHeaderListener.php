<?php

namespace CodeFlix\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;
use Tymon\JWTAuth\JWT;

class AddTokenToHeaderListener
{
    /**
     * @var JWT
     */
    private $JWT;

    /**
     * Create the event listener.
     *
     * @param JWT $JWT
     */
    public function __construct(JWT $JWT)
    {
        //
        $this->JWT = $JWT;
    }

    /**
     * Handle the event.
     *
     * @param  ResponseWasMorphed  $event
     * @return void
     */
    public function handle(ResponseWasMorphed $event)
    {
        $token = $this->JWT->getToken();
        if ($token){
            $event->response->headers->set('Authorization', "Bearer {$token->get()}");
        }
    }
}
