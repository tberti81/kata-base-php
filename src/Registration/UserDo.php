<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.06.
 * Time: 18:18
 */

namespace Kata\Registration;

class UserDo
{
	private $ip;
	private $ipRange;
	private $country;

	public function __construct($ip, GeoHelper $geoHelper)
	{
		$this->ip      = $ip;
		$this->ipRange = $geoHelper->getIpRangeByIp($ip);
		$this->country = $geoHelper->getCountryByIp($ip);
	}

	public function getIp()
	{
		return $this->ip;
	}

	public function getIpRange()
	{
		return $this->ipRange;
	}

	public function getCountry()
	{
		return $this->country;
	}
}