<?php

namespace AirSob;

use AirSob\AirSobMessage;

class AirSob{

	protected $service_id;
	protected $service_key;
	protected $format;
	protected $sms_url = "https://api.airsob.com/sms/";

	public function __construct($service_key,$service_id,$format = 'json')
	{
		$this->service_key = $service_key;
		$this->service_id = $service_id;
		$this->format = $format;
	}

	public function sendSMS(AirSobMessage $message)
	{
		return $this->handleSendMessage($message);
	}

	private function handleSendMessage(AirSobMessage $message_obj){
		$message = $message_obj->getMessage();
		$number = $message_obj->getDestination();
		$service_id = $this->service_id;
		$format = $this->format;
		$service_key = $this->service_key;
		$data = $message . ':' . $number . ':' . $service_id;
		$signature = hash_hmac('sha256', $data, $service_key);

		$values = array('message' => $message,
			'number' => $number,
			'service_id' => $service_id,
			'signature' => $signature,
			'format' => $format
		);
		$query = http_build_query($values);
		$url = $this->sms_url . "?" . $query;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		curl_close($ch);

		if($format == 'json'){
			return @json_decode($response);
		}

		return $response;
	}
}