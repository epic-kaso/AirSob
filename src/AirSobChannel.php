<?php

namespace AirSob;


use Exception;
use Illuminate\Notifications\Notification;
use AirSob\Exceptions\CouldNotSendNotification;
use AirSob\AirSob as AirSobClient;

class AirSobChannel {

/**
     * The Jusibe client instance.
     *
     * @var \AirSob\AirSob
     */
    protected $airsob;
    /**
     * The phone number notifications should be sent from.
     *
     * @var string
     */
    protected $from;
    /**
     * @param  AirSobClient  $airsob
     */
    public function __construct(AirSobClient $airsob)
    {
        $this->airsob = $airsob;
    }
    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return mixed
     *
     * @throws \AirSob\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('air-sob')) {
            throw CouldNotSendNotification::missingTo();
        }
        $message = $notification->toAirSob($notifiable);

        if (is_string($message)) {
            $message = new AirSobMessage($message);
        }

        $message->setDestination($to);

        try {
            $response = $this->airsob->sendSMS($message);
            return $response;
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}