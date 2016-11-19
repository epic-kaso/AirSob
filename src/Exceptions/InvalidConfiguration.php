<?php
namespace AirSob\Exceptions;

class InvalidConfiguration extends Exception{

	public static function configurationNotSet(){
		return new static('Configuration of Airsob not found, please create a configuration section in services.php with the key airsob and array value with keys service_key,service_id,format');
	}
}