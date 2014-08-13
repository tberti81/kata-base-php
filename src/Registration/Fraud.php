<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.07.
 * Time: 23:49
 */

namespace Kata\Registration;

class Fraud
{
	const ATTEMPT_LIMIT_BY_IP       = 3;
	const ATTEMPT_LIMIT_BY_IP_RANGE = 500;
	const ATTEMPT_LIMIT_BY_COUNTRY  = 1000;

	const VALID_ATTEMPT_TTL = 3600;

	/**
	 * @var Counter
	 */
	public $counter;

	public function __construct(Counter $counter)
	{
		$this->counter = $counter;
	}

	public function isFraud(UserDo $user)
	{
		return (
			$this->counter->getAttemptCountByIp($user->getIp()) > self::ATTEMPT_LIMIT_BY_IP ||
			$this->counter->getAttemptCountByIpRange($user->getIpRange()) > self::ATTEMPT_LIMIT_BY_IP_RANGE ||
			$this->counter->getAttemptCountByCountry($user->getCountry()) > self::ATTEMPT_LIMIT_BY_COUNTRY
		);
	}

	public function logAttempt(UserDo $user)
	{
		$this->counter->logAttemptByIp($user->getIp());
		if (!$this->isFraud($user)) {
			$this->counter->logAttemptByIpRange($user->getIpRange());
			$this->counter->logAttemptByCountry($user->getCountry());
		}
	}
}