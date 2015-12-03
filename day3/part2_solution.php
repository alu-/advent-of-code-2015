<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

$sSteps = file_get_contents(realpath(__DIR__) . '/part1_input.txt');
$iTotalSteps = mb_strlen($sSteps);
$aSantasData = array(
	'Santa' => array(
		'x' => 0,
		'y' => 0,
		'visits' => array('0x0' => 1)
	),
	'Robo-Santa' => array(
		'x' => 0,
		'y' => 0,
		'visits' => array('0x0' => 1)
	)
);
$bSantasTurn = true;
for( $iStep = 0; $iStep < $iTotalSteps; $iStep++ ) {
	$sStepDirection = $sSteps[$iStep];
	$sCurrentSanta = $bSantasTurn ? 'Santa' : 'Robo-Santa';
	switch( $sStepDirection ) {
		case '>':
			$aSantasData[$sCurrentSanta]['x'] += 1;
			break;
		case 'v':
			$aSantasData[$sCurrentSanta]['y'] -= 1;
			break;
		case '<':
			$aSantasData[$sCurrentSanta]['x'] -= 1;
			break;
		case '^':
			$aSantasData[$sCurrentSanta]['y'] += 1;
			break;
	}
	
	$sCoordinates = $aSantasData[$sCurrentSanta]['x'] . 'x' . $aSantasData[$sCurrentSanta]['y'];
	if( !array_key_exists($sCoordinates, $aSantasData[$sCurrentSanta]['visits']) ) {
		$aSantasData[$sCurrentSanta]['visits'][$sCoordinates] = 1;
	} else {
		$aSantasData[$sCurrentSanta]['visits'][$sCoordinates] += 1;
	}

	$bSantasTurn = !$bSantasTurn;
}

echo count($aSantasData['Santa']['visits'] + $aSantasData['Robo-Santa']['visits']);
