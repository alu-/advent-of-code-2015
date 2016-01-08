<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
ini_set('memory_limit', '128M');
$aInstructions = file(realpath(__DIR__) . '/part2_input.txt', FILE_IGNORE_NEW_LINES);

$aLightGrid = array_fill(0, 1000, array_fill(0, 1000, 0));
foreach( $aInstructions as $sInstruction ) {
	switch(substr($sInstruction, 0, 7)) {
		case 'turn on':
			$iOperation = 1;
			break;
		case 'turn of':
			$iOperation = -1;
			break;
		case 'toggle ':
			$iOperation = 2;
			break;
		default:
			Throw new UnexpectedValueException('Unhandled operation');
			break;
	}

	preg_match_all('/(\d{1,3},\d{1,3})(?:\s[a-z]*\s)(\d{1,3},\d{1,3})/', $sInstruction, $aCoordinates, PREG_SET_ORDER);

	list($iStartX, $iStartY) = explode(',', $aCoordinates[0][1]);
	list($iStopX, $iStopY) = explode(',', $aCoordinates[0][2]);

	for( $x = $iStartX; $x <= $iStopX; ++$x ) {
		for( $y = $iStartY; $y <= $iStopY; ++$y ) {
			$aLightGrid[$x][$y] += $iOperation;
			if( $aLightGrid[$x][$y] < 0 ) {
				$aLightGrid[$x][$y] = 0;
			}
		}
	}
}

$iTotalBrightness = 0;
foreach( $aLightGrid as $sCoordinateX => $aCoordinateY ) {
	foreach( $aCoordinateY as $sCoordinateY => $iBrightness ) {
		if( $iBrightness > 0 ) {
			$iTotalBrightness += $iBrightness;
		}
	}
}

echo 'Total brightness: ' . $iTotalBrightness;
