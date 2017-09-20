<?php

namespace Handler;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 */

use Telegram as B;
use Handler\Response;
use Handler\SaveEvent;

final class MainHandler
{
	/**
	 * @var array
	 */
	public $event = [];

	/**
	 * @var string
	 */
	public $msgtype;

	/**
	 * @var string
	 */
	public $chattype;

	/**
	 * @var string
	 */
	public $text;

	/**
	 * @var string
	 */
	public $lowertext;

	/**
	 * @var string
	 */
	public $username;

	/**
	 * @var string
	 */
	public $first_name;

	/**
	 * @var string
	 */
	public $last_name;

	/**
	 * @var string
	 */
	public $userid;

	/**
	 * @var string
	 */
	public $msgid;

	/**
	 * @var string
	 */
	public $date;

	/**
	 * @var string
	 */
	public $chat_id;


	/**

	 * @param string $webhook_input
	 */
	public function __construct($webhook_input = null)
	{
		if ($webhook_input) {
			$this->input = json_decode($webhook_input, true);
		} else {
			$this->input = json_decode(file_get_contents("php://input"), true);
		}
	}

	public function run()
	{
		$this->parseEvent();
		$this->response();
	}

	private function parseEvent()
	{
		if (isset($this->input['message']['text'])) {
			$this->msgtype  	= "text";
			$this->chattype 	= $this->input['message']['chat']['type'];
			$this->text     	= $this->input['message']['text'];
			$this->lowertext 	= strtolower($this->text);
			$this->username		= isset($this->input['message']['from']['username']) ? strtolower($this->input['message']['from']['username']) : null;
			$this->first_name   = $this->input['message']['from']['first_name'];
			$this->last_name    = isset($this->input['message']['from']['last_name']) ? $this->input['message']['from']['last_name'] : null;
			$this->userid		= $this->input['message']['from']['id'];
			$this->msgid		= $this->input['message']['message_id'];
			$this->date			= $this->input['message']['date'];
			$this->chat_id		= $this->input['message']['chat']['id'];
		}
	}

	private function response()
	{
		if ($this->msgtype == "text") {
			$res = new Response($this);
			$res->exec();
		}
	}

	private function save_event()
	{
		if ($this->msgtype == "text") {
			$se = new SaveEvent($this);
			$se->exec();
		}
	}
}

