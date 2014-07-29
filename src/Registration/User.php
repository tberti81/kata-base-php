<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 18:43
 */

namespace Kata\Registration;

class User
{
	/**
	 * @var Email
	 */
	private $email;

	/**
	 * @var Password
	 */
	private $password;

	public function __construct(Email $email, Password $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getPassword()
	{
		return $this->password;
	}
}