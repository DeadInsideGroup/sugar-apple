<?php

namespace Handler;

use DB;
use PDO;
use Telegram as B;
use Handler\Command;
use Handler\MainHandler;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

final class Response
{	
	use Command;

	/**
	 * @var Handler\MainHandler
	 */
	private $h;

	public function __construct(MainHandler $handler)
	{
		$this->h = $handler;
	}

	public function exec()
	{
		if ($this->h->msgtype == "new_chat_member") {
			$st = DB::prepare("SELECT `welcome_message` FROM `a_groups` WHERE `group_id`=:gid LIMIT 1");
			pc($st->execute(
				[
					":gid" => $this->h->chat_id
				]
			), $st);
			if ($st = $st->fetch(PDO::FETCH_NUM)) {
				if (! empty($st[0])) {
					return B::sendMessage(
						[
							"chat_id" 				=> $this->h->chat_id,
							"text"					=> $st[0],
							"reply_to_message_id"	=> $this->h->msgid
						]
					);
				}
			}
		}
		if (! $this->command()) {
			if (! $this->__lang_virtualizor()) {
				return false;
			}
		}
		return true;
	}

	private function __lang_virtualizor()
	{

	}
}