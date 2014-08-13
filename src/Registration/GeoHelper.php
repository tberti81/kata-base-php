<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.08.06.
 * Time: 19:08
 */

namespace Kata\Registration;

class GeoHelper
{
	public function getCountryByIp($ip)
	{
		$ipParts = explode('.', $ip);
		switch ($ipParts[2]) {
			case 1:
				$country = 'HU';
				break;

			case 2:
			case 3:
				$country = 'LU';
				break;

			case 4:
			case 5:
				$country = 'DE';
				break;

			case 6:
			case 7:
				$country = 'UK';
				break;

			default:
				$country = 'US';
		}

		return $country;
	}

	public function getIpRangeByIp($ip)
	{
		$ipParts = explode('.', $ip);

		if ($ipParts[3] > 0 && $ipParts[3] <= 10) {
			$ipRange = 10;
		}
		elseif ($ipParts[3] > 10 && $ipParts[3] <= 30) {
			$ipRange = 30;
		}
		elseif ($ipParts[3] > 30 && $ipParts[3] <= 60) {
			$ipRange = 60;
		}
		else {
			$ipRange = 100;
		}

		return $ipRange;
	}
}