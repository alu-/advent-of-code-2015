<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aReindeerData = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$aReindeerStats = array();
foreach( $aReindeerData as $sReindeer ) {
	preg_match('/\b(\w+)\b can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds./', $sReindeer, $aMatches);
	$aReindeerStats[$aMatches[1]] = array(
		'name' => $aMatches[1],
		'speed' => $aMatches[2],
		'stamina' => $aMatches[3],
		'recovery' => $aMatches[4],
		'raceData' => array(
			'inRecovery' => false,
			'recoveryTimer' => 0,
			'flightTimer' => 0,
			'distanceCovered' => 0,
			'points' => 0
		)
	);
}

for( $iRaceSeconds = 0; $iRaceSeconds < 2503; ++$iRaceSeconds ) {
	foreach( $aReindeerStats as &$aReindeer ) {
		if( $aReindeer['raceData']['inRecovery'] ) {
			// Handle recovery
			if( $aReindeer['raceData']['recoveryTimer'] === 1 ) {
				// Reset on one second so we can start directly on zero next loop
				$aReindeer['raceData'] = array_merge($aReindeer['raceData'], array(
					'inRecovery' => false,
					'recoveryTimer' => 0
				));
			} else {
				--$aReindeer['raceData']['recoveryTimer'];
			}
		} else {
			++$aReindeer['raceData']['flightTimer'];
			$aReindeer['raceData']['distanceCovered'] += $aReindeer['speed'];

			// Check if reindeer needs to recover
			if( $aReindeer['raceData']['flightTimer'] == $aReindeer['stamina'] ) {
				$aReindeer['raceData'] = array_merge($aReindeer['raceData'], array(
					'inRecovery' => true,
					'recoveryTimer' => $aReindeer['recovery'],
					'flightTimer' => 0
				));
			}
		}
	}

	// Extract reindeer names and distances
	$aDistances = array_combine(
		array_keys($aReindeerStats), 
		array_column(array_column($aReindeerStats, 'raceData'), 'distanceCovered')
	);
	arsort($aDistances);
	$iLongestDistance = current($aDistances);

	// Filter out the lower distance reindeers
	$aDistances = array_filter($aDistances, function($iItemDistance) use ($iLongestDistance) {
		if( $iItemDistance == $iLongestDistance ) {
			return true;
		}
	});

	// Award points
	foreach( $aDistances as $sReindeerName => $aDistance ) {
		++$aReindeerStats[$sReindeerName]['raceData']['points'];
	}
}
usort($aReindeerStats, function($a, $b) {
	return $b['raceData']['points'] - $a['raceData']['points'];
});

echo $aReindeerStats[0]['name'], ' won with ', $aReindeerStats[0]['raceData']['points'], ' points';
