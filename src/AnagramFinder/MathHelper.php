<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.28.
 * Time: 23:51
 */

namespace Kata\AnagramFinder;

class MathHelper
{
	public function countFactorial($number)
	{
		if ($number < 2) {
			return 1;
		}
		else {
			return ($number * $this->countFactorial($number - 1));
		}
	}
} 