<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aHappinessRules = file(realpath(__DIR__) . '/part1_input.txt');

$aPersonDispositions = array();
foreach( $aHappinessRules as $sRule ) {
	preg_match('/\b(\w+)\b would (\w+) (\d+) happiness units by sitting next to (\w+)./', $sRule, $aMatches);
	$aPersonDispositions[$aMatches[1]][$aMatches[4]] = intval(($aMatches[2] == 'lose' ? '-' : '') . $aMatches[3]);
}

function generatorArrayPermutations(array $aElements) {
	if( count($aElements) <= 1 ) {
		yield $aElements;
	} else {
		foreach( generatorArrayPermutations(array_slice($aElements, 1)) as $aPermutation ) {
			foreach( range(0, count($aElements) - 1) as $i ) {
				yield array_merge(array_slice($aPermutation, 0, $i), [$aElements[0]], array_slice($aPermutation, $i));
			}
		}
	}
}

// Iterate permutations and calculate the total happiness
$iNumberOfPersons = count($aPersonDispositions);
$iHighestHappiness = null;
$aOptimalPositions = array();
foreach( generatorArrayPermutations(array_keys($aPersonDispositions)) as $aPermutation ) {
	$iHappiness = 0;
	
	for( $i = 0; $i < $iNumberOfPersons; ++$i ) {
		$sCurrentPerson = $aPermutation[$i];
		
		// Left person
		$sLeftPerson = ( $i == 0 ? $aPermutation[$iNumberOfPersons - 1] : $aPermutation[$i - 1]);
		$iHappiness += $aPersonDispositions[$sCurrentPerson][$sLeftPerson];
		
		// Right person
		$sRightPerson = ( $i == $iNumberOfPersons - 1 ? $aPermutation[0] : $aPermutation[$i + 1]);
		$iHappiness += $aPersonDispositions[$sCurrentPerson][$sRightPerson];
	}
	
	if( $iHighestHappiness === null || $iHappiness > $iHighestHappiness) {
		$iHighestHappiness = $iHappiness;
		$aOptimalPositions = $aPermutation;
	}
}

echo 'Optimal positions: ', implode(' -> ', $aOptimalPositions), PHP_EOL, 'Happiness: ', $iHighestHappiness;
