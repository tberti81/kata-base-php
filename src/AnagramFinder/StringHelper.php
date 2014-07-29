<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.29.
 * Time: 0:10
 */

namespace Kata\AnagramFinder;

class StringHelper
{
	public function getCharactersOccurrences($string)
	{
		$occurrences = array();
		$count       = strlen($string);

		for ($i = 0; $i < $count; $i++) {
			if (!isset($occurrences[$string[$i]])) {
				$occurrences[$string[$i]] = 1;
			}
			else {
				$occurrences[$string[$i]]++;
			}
		}

		return $occurrences;
	}

	public function isMirrorString($string)
	{
		return ($string === strrev($string));
	}

	public function getMirrorStrings(array $haystack)
	{
		$mirrorStrings = array();
		foreach ($haystack as $needle) {
			if ($this->isMirrorString($needle)) {
				$mirrorStrings[] = $needle;
			}
		}

		sort($mirrorStrings);

		return $mirrorStrings;
	}
}