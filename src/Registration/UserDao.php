<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.30.
 * Time: 18:34
 */

namespace Kata\Registration;

class UserDao
{
	public function save(User $user)
	{
		return true;
	}

	public function checkIsEmailExists(Email $email)
	{
		return true;
	}
}