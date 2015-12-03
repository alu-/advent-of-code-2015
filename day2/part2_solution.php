<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aBoxes = file(realpath(__DIR__) . '/part2_input.txt', FILE_IGNORE_NEW_LINES);
$iTotalRibbonLength = 0;
foreach( $aBoxes as $sRawDimensions ) {
	$aPerimiters = explode('x', $sRawDimensions);
	$iTotalRibbonLength += $aPerimiters[0] * $aPerimiters[1] * $aPerimiters[2];
	
	sort($aPerimiters);
	array_pop($aPerimiters);
	$iTotalRibbonLength += ($aPerimiters[0] + $aPerimiters[0]) + ($aPerimiters[1] + $aPerimiters[1] );
}

echo $iTotalRibbonLength;
