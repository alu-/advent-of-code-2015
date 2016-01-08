<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aStrings = file(realpath(__DIR__) . '/part2_input.txt', FILE_IGNORE_NEW_LINES);

$iCharactersInMemory = 0;
$iCharactersInLiterial = 0;
foreach( $aStrings as $sString ) {
	$iCharactersInLiterial += strlen($sString);
	
	// Escape stuff
	$sString = str_replace( array(
		'\\',
		'"'
	), array(
		'\\\\',
		'\\"'
	), $sString);

	// Add starting and ending quotes
	$sString = '"' . $sString . '"';

	$iCharactersInMemory += strlen($sString);
}

echo 'Characters in literial: ' . $iCharactersInLiterial . PHP_EOL;
echo 'Characters in memory: ' . $iCharactersInMemory . PHP_EOL;
echo 'Delta: ' . ($iCharactersInMemory - $iCharactersInLiterial);
