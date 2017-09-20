<?php

namespace Handler;

use DB;
use PDO;
use Handler\MainHandler;

class SaveEvent
{	
	/**
	 * @var array
	 */
	private $event = [];

	/**
	 * @var Handler\MainHandler
	 */
	private $h;
	
	/**
	 * @param array $event
	 */
	public function __construct(MainHandler $handler)
	{
		$this->h = $handler;
	}

	public function save()
	{
		
	}
}