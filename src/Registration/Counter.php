<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.06.
 * Time: 17:43
 */

namespace Kata\Registration;

class Counter
{
	const TYPE_IP       = 'ip';
	const TYPE_IP_RANGE = 'ip_range';
	const TYPE_COUNTRY  = 'country';

	private $stack;

	public function __construct()
	{
		$this->stack = array();
	}

	public function logAttemptByIp($ip)
	{
		$this->log($this->getKey(self::TYPE_IP, $ip));
	}

	public function logAttemptByIpRange($ipRange)
	{
		$this->log($this->getKey(self::TYPE_IP_RANGE, $ipRange));
	}

	public function logAttemptByCountry($country)
	{
		$this->log($this->getKey(self::TYPE_COUNTRY, $country));
	}

	public function getAttemptsByIp($ip)
	{
		return (
			isset($this->stack[$this->getKey(self::TYPE_IP, $ip)])
				? $this->stack[$this->getKey(self::TYPE_IP, $ip)]
				: array()
		);
	}

	public function getAttemptCountByIp($ip)
	{
		return count($this->getAttemptsByIp($ip));
	}

	public function getAttemptsByIpRange($ipRange)
	{
		return (
			isset($this->stack[$this->getKey(self::TYPE_IP_RANGE, $ipRange)])
				? $this->stack[$this->getKey(self::TYPE_IP_RANGE, $ipRange)]
				: array()
		);
	}

	public function getAttemptCountByIpRange($ipRange)
	{
		return count($this->getAttemptsByIpRange($ipRange));
	}

	public function getAttemptsByCountry($country)
	{
		return (
			isset($this->stack[$this->getKey(self::TYPE_COUNTRY, $country)])
				? $this->stack[$this->getKey(self::TYPE_COUNTRY, $country)]
				: array()
		);
	}

	public function getAttemptCountByCountry($country)
	{
		return count($this->getAttemptsByCountry($country));
	}

	private function log($key)
	{
		$this->stack[$key][] = array(
			'createdAt' => time()
		);
	}

	private function getKeyPrefix($type)
	{
		switch ($type) {
			case self::TYPE_IP:
				$prefix = self::TYPE_IP;
				break;

			case self::TYPE_IP_RANGE:
				$prefix = self::TYPE_IP_RANGE;
				break;

			case self::TYPE_COUNTRY:
				$prefix = self::TYPE_COUNTRY;
				break;

			default:
				throw new \InvalidArgumentException();
		}

		return $prefix;
	}

	private function getKey($type, $data)
	{
		return implode('__', array($this->getKeyPrefix($type), $data));
	}
}