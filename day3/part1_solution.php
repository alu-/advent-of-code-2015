<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

$sSteps = file_get_contents(realpath(__DIR__) . '/part1_input.txt');
$iTotalSteps = mb_strlen($sSteps);
$aHouseVisits = array(
	'0x0' => 1 // Starting house
);
$iCurrentX = 0;
$iCurrentY = 0;
for( $iStep = 0; $iStep < $iTotalSteps; $iStep++ ) {
	$sStepDirection = $sSteps[$iStep];
	switch( $sStepDirection ) {
		case '>':
			$iCurrentX += 1;
			break;
		case 'v':
			$iCurrentY -= 1;
			break;
		case '<':
			$iCurrentX -= 1;
			break;
		case '^':
			$iCurrentY += 1;
			break;
	}
	if( !array_key_exists($iCurrentX . 'x' . $iCurrentY, $aHouseVisits) ) {
		$aHouseVisits[ $iCurrentX . 'x' . $iCurrentY ] = 1;
	} else {
		$aHouseVisits[ $iCurrentX . 'x' . $iCurrentY ] += 1;
	}
}
echo count($aHouseVisits);
