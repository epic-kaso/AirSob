<?php

namespace AirSob;

class AirSobMessage{
	  protected $destination;
	  protected $message;

	  public function __construct($destination,$message)
	  {	
	  		$this->destination = is_array($destination) ? implode(',', $destination) : $destination;
	  		$this->message = $message;
	  }

	  public function getDestination()
	  {
	  		return $this->destination;
	  }

	  public function getMessage()
	  {
	  		return $this->message;
	  }
}