<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$sInput = file_get_contents(realpath(__DIR__) . '/part1_input.txt');

$sResult = $sInput;
for( $i = 1; $i <= 40; ++$i ) {
	$sNewNumber = '';
	while( strlen($sResult) > 0 ) {
		$sFirstDigit = $sResult[0];
		$sStrippedString = ltrim($sResult, $sFirstDigit);
		$iNumberOfDigitsTrimmed = strlen($sResult) - strlen($sStrippedString);
		$sResult = $sStrippedString;
		$sNewNumber .= $iNumberOfDigitsTrimmed . $sFirstDigit;
	}
	$sResult = $sNewNumber;
}

echo strlen($sResult);
