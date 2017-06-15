<?php

namespace Kata\DataMunging;

/**
 * @package Tdd\DataMunging
 */
class DataMunger
{
	/**
	 * @param string $file
	 *
	 * @return string
	 */
	public function getDay($file)
	{
		$subjectPosition = 0;
		$diffAPosition   = 1;
		$diffBPosition   = 2;

		$data = $this->getDataFromFile($file);

		return $this->getSubjectByMinDiff($data, $subjectPosition, $diffAPosition, $diffBPosition);
	}

	/**
	 * @param string $file
	 *
	 * @return string
	 */
	public function getTeam($file)
	{
		$subjectPosition = 1;
		$diffAPosition   = 6;
		$diffBPosition   = 8;

		$data = $this->getDataFromFile($file);

		return $this->getSubjectByMinDiff($data, $subjectPosition, $diffAPosition, $diffBPosition);
	}

	/**
	 * @param string $file
	 *
	 * @return array
	 */
	private function getDataFromFile($file)
	{
		$data = [];

		$fileHandler = fopen($file, 'r');

		if ($fileHandler)
		{
			while (($buffer = fgets($fileHandler)) !== false)
			{
				$buffer = trim(preg_replace('!\s+!', ' ', $buffer));
				$data[] = explode(' ', $buffer);
			}

			fclose($fileHandler);
		}

		return $data;
	}

	/**
	 * @param array $data
	 * @param int   $subjectPosition
	 * @param int   $diffAPosition
	 * @param int   $diffBPosition
	 *
	 * @return string
	 */
	private function getSubjectByMinDiff(array $data, $subjectPosition, $diffAPosition, $diffBPosition)
	{
		$minSubject = null;
		$minDiff    = null;

		foreach ($data as $key => $item)
		{
			if (!is_numeric($item[0]))
			{
				continue;
			}

			$subject = $item[$subjectPosition];
			$diff    = abs((int)$item[$diffAPosition] - (int)$item[$diffBPosition]);

			if (null === $minSubject || $diff < $minDiff)
			{
				$minSubject = $subject;
				$minDiff    = $diff;
			}
		}

		return $minSubject;
	}
}