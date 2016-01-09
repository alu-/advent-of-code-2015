<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$sJson = file_get_contents(realpath(__DIR__) . '/part1_input.txt');

function iterateSomethingsAndSum(&$aData, &$iNumberSummary = 0) {
	foreach( $aData as $mData ) {
		switch(gettype($mData)) {
			case 'array':
				iterateSomethingsAndSum($mData, $iNumberSummary);
				break;

			case 'integer':
				$iNumberSummary += $mData;
				break;

			case 'string':
				continue;
				break;

			case 'object':
				// Check if this object has a "red" value
				$aObjectVars = get_object_vars($mData);
				if( array_search('red', $aObjectVars, true) === false ) {
					iterateSomethingsAndSum($mData, $iNumberSummary);
				}
				break;

			default:
				Throw new UnexpectedValueException("Unexpected variable type: " . gettype($mData));
				break;
		}
	}
	return $iNumberSummary;
}

$aJsonData = json_decode($sJson, false);
echo iterateSomethingsAndSum($aJsonData);
