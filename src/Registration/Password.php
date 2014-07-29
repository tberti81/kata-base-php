<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 17:34
 */

namespace Kata\Registration;

class Password
{
	private $password;

	public function __construct($password)
	{
		if (!$this->isValid($password)) {
			throw new \InvalidArgumentException;
		}
		$this->password = $this->encode($password);
	}

	public function get()
	{
		return $this->password;
	}

	private function encode($password)
	{
		return md5($password);
	}

	private function isValid($password)
	{
		return (strlen($password) >= 6 && strlen($password) <= 64);
	}
} 