<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.06.
 * Time: 17:41
 */

namespace Kata\Test\Registration;

use Kata\Registration\Counter;
use Kata\Registration\GeoHelper;
use Kata\Registration\UserDo;

class CounterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Counter
	 */
	private $counter;

	/**
	 * @var UserDo
	 */
	private $user;

	public function setUp()
	{
		$this->counter = new Counter();
	}

	public function testCountAttemptsByIp()
	{
		$this->createUserData();
		$this->counter->logAttemptByIp($this->user->getIp());
		$this->assertEquals(1, $this->counter->getAttemptCountByIp($this->user->getIp()));
		$this->counter->logAttemptByIp($this->user->getIp());
		$this->assertEquals(2, $this->counter->getAttemptCountByIp($this->user->getIp()));
	}

	public function testCountAttemptsByIpRange()
	{
		$this->createUserData();
		$this->counter->logAttemptByIpRange($this->user->getIpRange());
		$this->assertEquals(1, $this->counter->getAttemptCountByIpRange($this->user->getIpRange()));
		$this->counter->logAttemptByIpRange($this->user->getIpRange());
		$this->assertEquals(2, $this->counter->getAttemptCountByIpRange($this->user->getIpRange()));
	}

	public function testCountAttemptsByCountry()
	{
		$this->createUserData();
		$this->counter->logAttemptByCountry($this->user->getCountry());
		$this->assertEquals(1, $this->counter->getAttemptCountByCountry($this->user->getCountry()));
		$this->counter->logAttemptByCountry($this->user->getCountry());
		$this->assertEquals(2, $this->counter->getAttemptCountByCountry($this->user->getCountry()));
	}

	private function createUserData()
	{
		$geoHelper = new GeoHelper();
		$this->user = new UserDo('129.342.10.' . rand(1,100), $geoHelper);
	}
}
