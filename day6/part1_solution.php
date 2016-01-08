<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
ini_set('memory_limit', '128M');
$aInstructions = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES);

$aLightGrid = array_fill(0, 1000, array_fill(0, 1000, false));
foreach( $aInstructions as $sInstruction ) {
	switch(substr($sInstruction, 0, 7)) {
		case 'turn on':
			$sOperation = true;
			break;
		case 'turn of':
			$sOperation = false;
			break;
		case 'toggle ':
			$sOperation = '!';
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
			if( $sOperation === '!' ) {
				$aLightGrid[$x][$y] = !$aLightGrid[$x][$y];
			} else {
				$aLightGrid[$x][$y] = $sOperation;
			}
		}
	}
}

$iLightsOn = 0;
foreach( $aLightGrid as $sCoordinateX => $aCoordinateY ) {
	foreach( $aCoordinateY as $sCoordinateY => $bLightStatus ) {
		if( $bLightStatus === true ) {
			++$iLightsOn;
		}
	}
}

echo 'Lights turned on: ' . $iLightsOn;
