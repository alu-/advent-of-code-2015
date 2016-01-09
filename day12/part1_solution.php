<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$sJson = file_get_contents(realpath(__DIR__) . '/part1_input.txt');

function iterateAllTheThingsAndSum(&$aData, &$iNumberSummary = 0) {
	foreach( $aData as $mData ) {
		switch(gettype($mData)) {
			case 'array':
				iterateAllTheThingsAndSum($mData, $iNumberSummary);
				break;

			case 'integer':
				$iNumberSummary += $mData;
				break;

			case 'string':
				continue;
				break;

			default:
				Throw new UnexpectedValueException("Unexpected variable type: " . gettype($mData));
				break;
		}
	}
	return $iNumberSummary;
}

$aJsonData = json_decode($sJson, true);
echo iterateAllTheThingsAndSum($aJsonData);
