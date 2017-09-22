<?php

namespace Handler;

defined("PRIVATE_STORAGE") or die("PRIVATE_STORAGE not defined!\n");

final class Session
{
	/**
	 * @var string
	 */
	private $sessid;

	/**
	 * @var string
	 */
	private $sessfile;

	/**
	 * @var array
	 */
	private $sessdata = [];

	/**
	 * @param string $sessid
	 */
	public function __construct($sessid)
	{
		$this->sessid   = sha1($sessid);
		$this->sessfile = PRIVATE_STORAGE."/session/".$this->sessid.".json";
		$this->__init();
	}

	/**
	 * Init file and property.
	 */
	private function __init()
	{
		is_dir(PRIVATE_STORAGE."/session") or mkdir(PRIVATE_STORAGE."/session");
		if (file_exists($this->sessfile)) {
			$this->sessdata = json_decode(file_get_contents($this->sessfile), true);
		} else {
			file_put_contents($this->sessfile, "", LOCK_EX);
		}
	}

	/**
	 * Set session.
	 * @param string $key
	 * @param string $value
	 * @return bool
	 */
	public function set($key, $value)
	{
		$this->sessdata[$key] = $value;
		return (bool)file_put_contents($this->sessfile, json_encode($this->sessdata), LOCK_EX);
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		$this->sessdata = json_decode(file_get_contents($this->sessfile), true);
		if (isset($this->sessdata[$key])) {
			return $this->sessdata[$key];
		} else {
			return false;
		}
	}

	public function __destruct()
	{
		file_put_contents($this->sessfile, json_encode($this->sessdata), LOCK_EX);
	}

	public function destroy()
	{
		$this->sessdata = [];
		return unlink($this->sessfile);
	}
}