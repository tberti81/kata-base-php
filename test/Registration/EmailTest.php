<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 18:04
 */

namespace Kata\Test\Registration;

use Kata\Registration\Email;

class EmailTest extends \PHPUnit_Framework_TestCase
{
	public function testEmailGetter()
	{
		$email = new Email('user@domain.tld');
		$this->assertEquals('user@domain.tld', $email->get());
	}

	/**
	 * @dataProvider invalidEmailDataProvider
	 * @expectedException InvalidArgumentException
	 */
	public function testEmailValidation($emailAddress)
	{
		$email = new Email($emailAddress);
	}

	public function invalidEmailDataProvider()
	{
		return array(
			array('plainaddress'),
			array('#@%^%#$@#$@#.com'),
			array('@example.com'),
			array('Joe Smith <email@example.com'),
			array('email.example.com'),
			array('email@example@example.com'),
			array('.email@example.com'),
			array('email.@example.com'),
			array('email..email@example.com'),
			array('あいうえお@example.com'),
			array('email@example.com (Joe Smith)'),
			array('email@example'),
			array('email@111.222.333.44444'),
			array('email@example..com'),
			array('Abc..123@example.com'),
		);
	}
}
 