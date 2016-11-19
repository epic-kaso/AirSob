<?php

namespace AirSob\Exceptions;

class CouldNotSendNotification extends Exception{

	public static function missingTo(){
		return new static('The Destination is not provided');
	}

	public static function serviceRespondedWithAnError($e){
		return new static('Failed to Send Notification: '.$e->getMessage(),$e->getTrace());
	}
}