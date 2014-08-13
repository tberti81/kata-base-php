<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.07.
 * Time: 23:46
 */

namespace Kata\Test\Registration;

use Kata\Registration\Counter;
use Kata\Registration\Fraud;
use Kata\Registration\GeoHelper;
use Kata\Registration\UserDo;

class FraudTest extends \PHPUnit_Framework_TestCase
{
	public function testLimits()
	{
		$this->assertEquals(3, Fraud::ATTEMPT_LIMIT_BY_IP);
		$this->assertEquals(500, Fraud::ATTEMPT_LIMIT_BY_IP_RANGE);
		$this->assertEquals(1000, Fraud::ATTEMPT_LIMIT_BY_COUNTRY);
	}

	public function testIsFraudByIp()
	{
		$geoHelper = new GeoHelper();
		$user      = new UserDo('123.21.4.20', $geoHelper);
		$counter   = new Counter();
		$fraud     = new Fraud($counter);

		$this->assertFalse($fraud->isFraud($user));

		for ($i = 0; $i < Fraud::ATTEMPT_LIMIT_BY_IP + 1; $i++) {
			$counter->logAttemptByIp($user->getIp());
		}

		$this->assertTrue($fraud->isFraud($user));
	}

	public function testIsFraudByIpRange()
	{
		$geoHelper = new GeoHelper();
		$user      = new UserDo('123.21.4.20', $geoHelper);
		$counter   = new Counter();
		$fraud     = new Fraud($counter);

		$this->assertFalse($fraud->isFraud($user));

		for ($i = 0; $i < Fraud::ATTEMPT_LIMIT_BY_IP_RANGE + 1; $i++) {
			$counter->logAttemptByIpRange($user->getIpRange());
		}

		$this->assertTrue($fraud->isFraud($user));
	}

	public function testIsFraudByCountry()
	{
		$geoHelper = new GeoHelper();
		$user      = new UserDo('123.21.4.20', $geoHelper);
		$counter   = new Counter();
		$fraud     = new Fraud($counter);

		$this->assertFalse($fraud->isFraud($user));

		for ($i = 0; $i < Fraud::ATTEMPT_LIMIT_BY_COUNTRY + 1; $i++) {
			$counter->logAttemptByCountry($user->getCountry());
		}

		$this->assertTrue($fraud->isFraud($user));
	}

	public function testCountLogic()
	{
		$geoHelper = new GeoHelper();
		$user      = new UserDo('123.21.4.20', $geoHelper);
		$counter   = new Counter();
		$fraud     = new Fraud($counter);

		$forceData = array(
			array(
				'ip' => '123.21.4.20',
				array(
					array('createdAt' => 1407793597),
					array('createdAt' => 1407793598),
					array('createdAt' => 1407793600),
				)
			),
			array(
				'ipRange' => '30',
				array(
					array('createdAt' => 1407793597),
					array('createdAt' => 1407793598),
					array('createdAt' => 1407793600),
					array('createdAt' => 1407793601),
					array('createdAt' => 1407793602),
					array('createdAt' => 1407793607),
				)
			),
			array(
				'country' => 'DE',
				array(
					array('createdAt' => 1407793597),
					array('createdAt' => 1407793598),
					array('createdAt' => 1407793600),
					array('createdAt' => 1407793601),
					array('createdAt' => 1407793602),
					array('createdAt' => 1407793607),
					array('createdAt' => 1407793627),
					array('createdAt' => 1407793631),
					array('createdAt' => 1407793652),
				)
			),
		);
		$this->forceHistory($counter, $forceData);
		for ($i = 1; $i < 5; $i++) {
			$currentState = array(
				'ip'      => $counter->getAttemptCountByIp($user->getIp()),
				'ipRange' => $counter->getAttemptCountByIpRange($user->getIpRange()),
				'country' => $counter->getAttemptCountByCountry($user->getCountry()),
			);

			$isFraud = $fraud->isFraud($user);
			$fraud->logAttempt($user);
			$this->assertEquals($currentState['ip'] + 1, $counter->getAttemptCountByIp($user->getIp()));
			if (!$isFraud) {
				$this->assertEquals($currentState['ipRange'] + 1, $counter->getAttemptCountByIpRange($user->getIpRange()));
				$this->assertEquals($currentState['country'] + 1, $counter->getAttemptCountByCountry($user->getCountry()));
			}
			else {
				$this->assertEquals($currentState['ipRange'], $counter->getAttemptCountByIpRange($user->getIpRange()));
				$this->assertEquals($currentState['country'], $counter->getAttemptCountByCountry($user->getCountry()));
			}
		}
	}

	public function testTtl()
	{
		$this->assertEquals(3600, Fraud::VALID_ATTEMPT_TTL);
	}

	public function testLastHourCounts()
	{
		$counter = $this->getMockBuilder('\\Kata\\Registration\\Counter')
			->disableOriginalConstructor()
			->getMock();

		$counter->expects($this->exactly(2))
			->method('getAttemptCountByIp')
			->will($this->onConsecutiveCalls(1, 2));

		$geoHelper = new GeoHelper();
		$user      = new UserDo('123.21.4.20', $geoHelper);
		$fraud     = new Fraud($counter);
		$fraud->logAttempt($user);
		$this->assertEquals(2, $counter->getAttemptCountByIp('123.21.4.20'));
	}

	private function forceHistory(Counter $counter, array $data)
	{
		for ($i = 1; $i <= $data[0]['attemptCount']; $i++) {
			$counter->logAttemptByIp($data[0]['ip']);
		}
		for ($i = 1; $i <= $data[1]['attemptCount']; $i++) {
			$counter->logAttemptByIpRange($data[1]['ipRange']);
		}
		for ($i = 1; $i <= $data[2]['attemptCount']; $i++) {
			$counter->logAttemptByCountry($data[2]['country']);
		}
	}
}
