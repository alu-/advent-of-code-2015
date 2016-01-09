<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aLocations = file(realpath(__DIR__) . '/part2_input.txt', FILE_IGNORE_NEW_LINES);

$aDistances = array();
$aUniqueLocations = array();
foreach( $aLocations as $sLocation ) {
	list($sFrom, $sToWord, $sTo, $sEquals, $iDistance) = explode(' ', $sLocation);
	$aDistances[$sFrom][$sTo] = $iDistance;
	$aDistances[$sTo][$sFrom] = $iDistance;

	if( !in_array($sFrom, $aUniqueLocations) ) {
		$aUniqueLocations[] = $sFrom;
	}
	if( !in_array($sTo, $aUniqueLocations) ) {
		$aUniqueLocations[] = $sTo;
	}
}
sort($aUniqueLocations);

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

// Iterate permutations and calculate the route's distance, if it is a valid route
$iLongestDistance = null;
$aLongestRoute = array();
foreach( generatorArrayPermutations($aUniqueLocations) as $aPermutation ) {
	$iDistance = 0;
	$iRouteHops = count($aPermutation);
	for($i = 0; $i < $iRouteHops - 1; ++$i ) {
		$iDistance += $aDistances[$aPermutation[$i]][$aPermutation[$i + 1]];
	}
	
	if( $iLongestDistance === null || $iDistance > $iLongestDistance) {
		$iLongestDistance = $iDistance;
		$aLongestRoute = $aPermutation;
	}
}

echo 'Longest route: ', implode(' -> ', $aLongestRoute), PHP_EOL, 'Distance: ' . $iLongestDistance;
