<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.28.
 * Time: 23:47
 */

namespace Kata\Test\AnagramFinder;

use Kata\AnagramFinder\MathHelper;

class MathHelperTest extends \PHPUnit_Framework_TestCase
{
	public function testFactorialCount()
	{
		$mathHelper = new MathHelper();
		$this->assertEquals(120, $mathHelper->countFactorial(5));
	}
}
 