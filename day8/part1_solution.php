<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aStrings = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES);

$iCharactersInMemory = 0;
$iCharactersInLiterial = 0;
foreach( $aStrings as $sString ) {
	$iCharactersInLiterial += strlen($sString);
	
	// Trim out quotes
	$sString = trim($sString, '"');

	// Unescape stuff
	$sString = str_replace( array(
		'\\\\',
		'\"'
	), array(
		'-',
		'"'
	), $sString);

	// Handle hex
	$sString = preg_replace('/(\\\x[0-9A-F]{1,2})/i', '_', $sString);
	
	$iCharactersInMemory += strlen($sString);
}

echo $iCharactersInLiterial - $iCharactersInMemory;
