<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

$sString = file_get_contents(realpath(__DIR__) . '/part2_input.txt');
$iStringLength = mb_strlen($sString);
$iCurrentFloor = 0;
for( $iCharacterPosition = 0; $iCharacterPosition <= $iStringLength; $iCharacterPosition++ ) {
	$sCurrentCharacter = $sString[$iCharacterPosition];
	if( $sCurrentCharacter == '(' ) {
		$iCurrentFloor++;
	} else if( $sCurrentCharacter == ')' ) {
		$iCurrentFloor--;
	}

	if( $iCurrentFloor == '-1' ) {
		break;
	}
}

echo $iCharacterPosition + 1;
