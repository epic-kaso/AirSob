<?php

namespace AirSob;

class AirSobMessage{
	  protected $destination;
	  protected $message;

	  public function __construct($message)
	  {	
	  		$this->message = $message;
	  }

	  public function setDestination($destination)
	  {
	  		$this->destination = is_array($destination) ? implode(',', $destination) : $destination;
	  }

	  public function setMesssage($message)
	  {
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