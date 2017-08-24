<?php

namespace Kata\AlphabetWar;

use InvalidArgumentException;

class AlphabetWar
{
	/**
	 * @param string $battlefield
	 *
	 * @return string
	 */
	public function getSurvivors($battlefield)
	{
		if (!preg_match('/^[a-z#\[\]]+$/', $battlefield))
		{
			throw new InvalidArgumentException();
		}

		// No strike -> all survive
		if (strpos($battlefield, '#') === false)
		{
			return str_replace('[', '', str_replace(']', '', $battlefield));
		}

		// Strike without shelter  => no survivor
		if (strpos($battlefield, '#') !== false && strpos($battlefield, '[') === false && strpos($battlefield, ']') === false)
		{
			return '';
		}

		// Get shelter positions with group of sheltered letters
		preg_match_all('|\[([^\]]+)\][.]*]*|', $battlefield, $shelters, PREG_OFFSET_CAPTURE);
		$shelterPositions = [];
		foreach ($shelters[1] as $shelter)
		{
			// shelter[position] = group of sheltered letters
			$shelterPositions[$shelter[1]] = $shelter[0];
		}

		// Get strike positions
		preg_match_all('|[#]|', $battlefield, $strikes, PREG_OFFSET_CAPTURE);
		$strikePositions = [];
		foreach ($strikes[0] as $strike)
		{
			// strike[position] = letter;
			$strikePositions[$strike[1]] = $strike[0];
		}

		// Merge strikes and group of sheltered letters ordered by position
		$clearedBattlefield = $shelterPositions + $strikePositions;
		ksort($clearedBattlefield);

		// Logic
		$strikeCount          = 0;
		$lastLetter           = null;
		$lastShelterPosition  = null;

		foreach ($clearedBattlefield as $position => &$letter)
		{
			// Strike
			if ($letter === '#')
			{
				// Group of sheltered letters die if strike count will be >= 2 with this strike
				if ($strikeCount >= 1)
				{
					// Increase strike count only if the previous letter was strike to be able to hit the next group of sheltered letters
					if ($lastLetter === '#')
					{
						$strikeCount++;
					}

					unset($clearedBattlefield[$lastShelterPosition]);
				}
				// Will be the first strike
				else
				{
					$strikeCount++;
				}
			}
			// Shelter
			else
			{
				// Save it to be able to kill them backward
				$lastShelterPosition = $position;

				// Group of sheltered letters die
				if ($strikeCount >= 2)
				{
					$strikeCount = 0;

					unset($clearedBattlefield[$position]);
				}
			}

			$lastLetter = $letter;
		}

		$result = '';

		// Get only the survivor group of sheltered letters from the field
		foreach ($clearedBattlefield as $battlefieldLetter)
		{
			// Not strike
			if ($battlefieldLetter !== '#')
			{
				$result .= $battlefieldLetter;
			}
		}

		return $result;
	}

}