<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.28.
 * Time: 22:36
 */

namespace Kata\Test\AnagramFinder;

use Kata\AnagramFinder\AnagramFinder;
use Kata\AnagramFinder\MathHelper;
use Kata\AnagramFinder\StringHelper;

class AnagramFinderTest extends \PHPUnit_Framework_TestCase
{
	/** @var StringHelper */
	private $stringHelper;

	/** @var MathHelper */
	private $mathHelper;

	public function setUp()
	{
		$this->stringHelper = new StringHelper();
		$this->mathHelper   = new MathHelper();
	}

	public function testNeedToFindAnagrams()
	{
		$anagramFinder = new AnagramFinder('be', $this->mathHelper, $this->stringHelper);

		$this->assertTrue($anagramFinder->hasAnagrams());
	}

	public function testNotNeedToFindAnagrams()
	{
		$anagramFinder = new AnagramFinder('bb', $this->mathHelper, $this->stringHelper);

		$this->assertFalse($anagramFinder->hasAnagrams());
		$this->assertEquals('bb', $anagramFinder->getAll());
	}

	public function testGetAnagrams()
	{
		$anagramFinder = new AnagramFinder('be', $this->mathHelper, $this->stringHelper);

		$this->assertSame(array('be', 'eb'), $anagramFinder->getAll());
	}

	public function testGetTotalCount()
	{
		$anagramFinder = new AnagramFinder('aabb', $this->mathHelper, $this->stringHelper);

		$this->assertEquals(6, $anagramFinder->getTotalCount());
	}

	public function testGetMirrorWords()
	{
		$anagramFinder = new AnagramFinder('aabb', $this->mathHelper, $this->stringHelper);

		$this->assertSame(array('abba', 'baab'), $this->stringHelper->getMirrorStrings($anagramFinder->getAll()));
	}
}
 