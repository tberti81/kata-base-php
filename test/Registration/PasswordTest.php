<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 17:30
 */

namespace Kata\Test\Registration;

use Kata\Registration\Password;

class PasswordTest extends \PHPUnit_Framework_TestCase
{

	public function testPasswordEncode()
	{
		$passwordString = 'jelszo';
		$password = new Password($passwordString);
		$this->assertEquals(md5($passwordString), $password->get());
	}

	/**
	 * @dataProvider invalidPasswordDataProvider
	 * @expectedException InvalidArgumentException
	 */
	public function testPasswordConstructThrowsAnException($password)
	{
		$password = new Password($password);
	}

	public function invalidPasswordDataProvider()
	{
		return array(
			array('jelsz'),
			array('jelszojelszojelszojelszojelszojelszojelszojelszojelszojelszojelszo'),
		);
	}
}
 