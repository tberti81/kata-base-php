<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.30.
 * Time: 17:49
 */

namespace Kata\Registration;

use Kata\Registration\Exception\NonUniqueEmailException;

class Registration
{
	/**
	 * @var User
	 */
	private $user;

	/**
	 * @var UserDao
	 */
	private $userDao;

	public function __construct(User $user, UserDao $userDao)
	{
		$this->user = $user;
		$this->userDao = $userDao;
	}

	public function register()
	{
		if ($this->userDao->checkIsEmailExists($this->user->getEmail())) {
			throw new NonUniqueEmailException;
		}

		return $this->userDao->save($this->user);
	}
}