<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 18:07
 */

namespace Kata\Registration;

class Email
{
	private $email;

	public function __construct($email)
	{
		if (!$this->isValid($email)) {
			throw new \InvalidArgumentException;
		}

		$this->email = $email;
	}

	public function get()
	{
		return $this->email;
	}

	private function isValid($email)
	{
		return (bool)preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email);
	}
} 