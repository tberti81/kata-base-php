<?php

namespace Kata\Test\AlphabetWar;

use InvalidArgumentException;
use Kata\AlphabetWar\AlphabetWar;
use PHPUnit_Framework_TestCase;

class AlphabetWarTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var AlphabetWar
	 */
	private $subject;

	public function setUp()
	{
		$this->subject = new AlphabetWar();
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetSurvivorsThrowsExceptionWhenInvalidArgumentGiven()
	{
		$this->subject->getSurvivors('');
	}

	/**
	 *
	 */
	public function testGetSurvivorsReturnsAllLettersWhenNoStrikeGiven()
	{
		$this->assertEquals('asbddjsk', $this->subject->getSurvivors('asbddjsk'));
		$this->assertEquals('asbddjsk', $this->subject->getSurvivors('as[bdd]jsk'));
		$this->assertEquals('asbddjsk', $this->subject->getSurvivors('as[bdd]js[k]'));
	}

	/**
	 *
	 */
	public function testGetSurvivorsReturnsEmptyWhenStrikeGivenWithoutShelter()
	{
		$this->assertEquals('', $this->subject->getSurvivors('asb#ddjsk'));
	}

	/**
	 * @dataProvider battleFieldProvider
	 *
	 * @param string $battleField
	 * @param string $survivors
	 */
	public function testGetSurvivors($battleField, $survivors)
	{
		$this->assertEquals($survivors, $this->subject->getSurvivors($battleField));
	}

	/**
	 * @return array
	 */
	public function battleFieldProvider()
	{
		return [
			[
				'abd#s[fhg]j#',
				''
			],
			[
				'abd#s[fhg]j',
				'fhg'
			],
			[
				'[fsdf][dsgg]a##sd[dfsf]b[sd]g#f[dee]d#g[gg]##',
				'fsdfsd'
			],
			[
				'#[fsdf][dsgg]a##sd[dfsf]b[sd]g#f[dee]d#g[gg]##',
				'fsdfsd'
			],
			[
				'abde[fgh]ijk',
				'abdefghijk'
			],
			[
				'ab#de[fgh]ijk',
				'fgh'
			],
			[
				'ab#de[fgh]ij#k',
				''
			],
			[
				'##abde[fgh]ijk',
				''
			],
			[
				'##ab#de[fgh]ijk[mn]op',
				'mn'
			],
			[
				'#ab#de[fgh]ijk[mn]op',
				'mn'
			],
			[
				'#abde[fgh]i#jk[mn]op',
				'mn'
			],
			[
				'[a]#[b]#[c]',
				'ac'
			],
			[
				'[a]#b#[c][d]',
				'd'
			],
			[
				'[a][b][c]',
				'abc'
			],
			[
				'##a[a]b[c]#',
				'c'
			]
		];
	}
}
 