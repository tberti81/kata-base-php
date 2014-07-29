<?php
/**
 * Created by PhpStorm.
 * User: Bertold
 * Date: 2014.07.28.
 * Time: 22:46
 */

namespace Kata\AnagramFinder;

class AnagramFinder
{
	private $string;

	private $mathHelper;

	private $stringHelper;

	private $characterOccurrences;

	public function __construct($string, MathHelper $mathHelper, StringHelper $stringHelper)
	{
		$this->string               = $string;
		$this->mathHelper           = $mathHelper;
		$this->stringHelper         = $stringHelper;
		$this->characterOccurrences = $this->stringHelper->getCharactersOccurrences($this->string);
	}

	public function hasAnagrams()
	{
		if (count($this->characterOccurrences) > 1) {
			return true;
		}
		else {
			return false;
		}
	}

	public function getAll()
	{
		if (!$this->hasAnagrams()) {
			return $this->string;
		}

		$anagrams = array();

		$totalCount = $this->getTotalCount();
		while (count($anagrams) < $totalCount) {
			$shuffledString = str_shuffle($this->string);
			if (!in_array($shuffledString, $anagrams)) {
				$anagrams[] = $shuffledString;
			}
		}

		sort($anagrams);

		return $anagrams;
	}

	public function getTotalCount()
	{
		$q = 1;
		foreach ($this->characterOccurrences as $character => $numberOfOccurrence) {
			$q *= $this->mathHelper->countFactorial($numberOfOccurrence);
		}

		return $this->mathHelper->countFactorial(strlen($this->string)) / $q;
	}
}