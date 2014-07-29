<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 0:10
 */

namespace Kata\Test\AnagramFinder;

use Kata\AnagramFinder\StringHelper;

class StringHelperTest extends \PHPUnit_Framework_TestCase
{
	/** @var StringHelper */
	private $stringHelper;

	public function setUp()
	{
		$this->stringHelper = new StringHelper();
	}

	public function testGetCharactersOccurrences()
	{
		$this->assertSame(array('a' => 2, 'b' => 1), $this->stringHelper->getCharactersOccurrences('aab'));
	}

	public function testIsMirrorString()
	{
		$this->assertTrue($this->stringHelper->isMirrorString('abba'));
		$this->assertFalse($this->stringHelper->isMirrorString('abbbb'));
	}

	/**
	 * @dataProvider mirrorStringDataProvider
	 */
	public function testGetMirrorStrings(array $strings)
	{
		$this->assertSame(array('moppom', 'opmmpo', 'pommop'), $this->stringHelper->getMirrorStrings($strings));
	}

	public function mirrorStringDataProvider()
	{
		return array(
			array(array('pompom', 'pommop', 'opommp', 'moppom', 'opmmpo')),
		);
	}
}
 