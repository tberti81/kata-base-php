<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 18:36
 */

namespace Kata\Test\Registration;

use Kata\Registration\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
	public function testSetUserEmail()
	{
		$email = $this->getMockBuilder('\\Kata\\Registration\\Email')
			->disableOriginalConstructor()
			->getMock();

		$password = $this->getMockBuilder('\\Kata\\Registration\\Password')
			->disableOriginalConstructor()
			->getMock();

		$user = new User($email, $password);
		$this->assertEquals($email, $user->getEmail());
		$this->assertEquals($password, $user->getPassword());
	}
}
 