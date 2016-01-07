<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aStrings = file(realpath(__DIR__) . '/part2_input.txt', FILE_IGNORE_NEW_LINES);

$iNiceCount = 0;
$iNaughtyCount = 0;
foreach( $aStrings as $sString ) {
	$aPermutations = array();
	$bFoundRepeatingLetter = false;
	$iStringLength = strlen($sString);
	for( $i = 0; $i < $iStringLength; $i++ ) {
		// Calculate permutations
		if( $i + 1 < $iStringLength ) {
			$aPermutations[] = $sString[$i] . $sString[$i + 1];
		}

		// Check for repeating letters with one letter in between
		if( $bFoundRepeatingLetter === false && $i > 1 ) {
			$sLeftChar = $sString[$i - 2];
			if( $sString[$i - 2] == $sString[$i] ) {
				$bFoundRepeatingLetter = true;
			}
		}
	}

	$aPermutationCount = array_count_values($aPermutations);
	// Last check for overlapping letters
	foreach( $aPermutationCount as $sLetterCombination => $iMatches ) {
		if( $iMatches > 1 ) {
			$iFirstMatchPosition = strpos($sString, $sLetterCombination);
			if( strpos($sString, $sLetterCombination, $iFirstMatchPosition + 2) === false ) {
				// Did not find another match, so this letter combination is not valid
				unset($aPermutationCount[$sLetterCombination]);
			}
		}
	}
	if( max($aPermutationCount) > 1 && $bFoundRepeatingLetter ) {
		++$iNiceCount;
	} else {
		++$iNaughtyCount;
	}
}

echo "Nice: ", $iNiceCount, PHP_EOL, "Naughty: ", $iNaughtyCount, PHP_EOL, "Total strings: ",  count($aStrings), PHP_EOL;
