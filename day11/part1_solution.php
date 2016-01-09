<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$sInput = file_get_contents(realpath(__DIR__) . '/part1_input.txt');

// Make an array of all three increasing straight letters
$aIncreasingLetters = array();
foreach( range('a', 'x' ) as $sLetter ) {
	$sNewLetter = $sLetter;
	$sNewLetter .= ++$sLetter;
	$sNewLetter .= ++$sLetter;
	
	$aIncreasingLetters[] = $sNewLetter;
}

$sNewPassword = $sInput;
while( true ) {
	/*
	 * @todo Increment could be improved by skipping "i", "o" or "l"..
	 */
	++$sNewPassword;
	
	// Test for blacklisted letters
	if( 
		strpos($sNewPassword, 'i') !== false ||
		strpos($sNewPassword, 'o') !== false ||
		strpos($sNewPassword, 'l') !== false
	) {
		continue;
	}
	
	// Test for three straight increasing letters
	$bIncreasingLetters = false;
	foreach( $aIncreasingLetters as $sLetterCombination ) {
		if( strpos($sNewPassword, $sLetterCombination) !== false ) {
			$bIncreasingLetters = true;
		}
	}
	if( !$bIncreasingLetters ) {
		continue;
	}
	
	// Test for at least two different, non-overlapping pairs of letters
	if( preg_match_all( '/([a-z])\1+/', $sNewPassword, $aMatches) >= 2 ) {
		break;
	}
}

echo 'New password: ' . $sNewPassword . PHP_EOL;
