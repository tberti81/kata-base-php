<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.30.
 * Time: 17:41
 */

namespace Kata\Test\Registration;

use Kata\Registration\Email;
use Kata\Registration\Registration;

class RegistrationTest extends \PHPUnit_Framework_TestCase
{
	public function testRegister()
	{
		$email = $this->getMockBuilder('\\Kata\\Registration\\Email')
			->disableOriginalConstructor()
			->getMock();

		$password = $this->getMockBuilder('\\Kata\\Registration\\Password')
			->disableOriginalConstructor()
			->getMock();

		$user = $this->getMockBuilder('\\Kata\\Registration\\User')
			->setConstructorArgs(array($email, $password))
			->getMock();

		$user->expects($this->any())
			->method('getEmail')
			->will($this->returnValue($email));

		$userDao = $this->getMockBuilder('\\Kata\\Registration\\UserDao')
			->getMock();

		$userDao->expects($this->once())
			->method('checkIsEmailExists')
			->with($email)
			->will($this->returnValue(false));

		$userDao->expects($this->once())
			->method('save')
			->with($user)
			->will($this->returnValue(true));

		$registration = new Registration($user, $userDao);
		$this->assertTrue($registration->register());
	}

	/**
	 * @expectedException \Kata\Registration\Exception\NonUniqueEmailException
	 */
	public function testEmailIsUnique()
	{
		$email = new Email('sdas@dsf.hf');

		$user = $this->getMockBuilder('\\Kata\\Registration\\User')
			->disableOriginalConstructor()
			->getMock();

		$user->expects($this->any())
			->method('getEmail')
			->will($this->returnValue($email));

		$userDao = $this->getMockBuilder('\\Kata\\Registration\\UserDao')
			->getMock();

		$userDao->expects($this->once())
			->method('checkIsEmailExists')
			->with($email)
			->will($this->returnValue(true));

		$registration = new Registration($user, $userDao);
		$registration->register();
	}
}
