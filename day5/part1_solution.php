<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aStrings = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES);

$iNiceCount = 0;
$iNaughtyCount = 0;
foreach ($aStrings as $sString) {
    // It contains at least three vowels (aeiou only), like aei, xazegov, or aeiouaeiouaeiou.
    $aVowelCounts = array(
        'a' => substr_count($sString, 'a'), 
        'e' => substr_count($sString, 'e'), 
        'i' => substr_count($sString, 'i'), 
        'o' => substr_count($sString, 'o'), 
        'u' => substr_count($sString, 'u')
    );
    if (array_sum($aVowelCounts) >= 3) {
        // It contains at least one letter that appears twice in a row, like xx, abcdde (dd), or aabbccdd (aa, bb, cc, or dd).
        $iStringLength = strlen($sString);
        $sPreviousLetter = null;
        $bLetterInRow = false;
        for ($i = 0; $i < $iStringLength; $i++) {
            if ($sString[$i] === $sPreviousLetter) {
                $bLetterInRow = true;
                break;
            }
            $sPreviousLetter = $sString[$i];
        }

        if ($bLetterInRow) {
            // It does not contain the strings ab, cd, pq, or xy, even if they are part of one of the other requirements.
            if( 
                strpos($sString, 'ab') === false &&
                strpos($sString, 'cd') === false &&
                strpos($sString, 'pq') === false &&
                strpos($sString, 'xy') === false
            ) {
                ++$iNiceCount;
            } else {
                ++$iNaughtyCount;
            }
        } else {
            ++$iNaughtyCount;
        }
    } else {
        ++$iNaughtyCount;
    }
}

echo "Nice: ", $iNiceCount, PHP_EOL, "Naughty: ", $iNaughtyCount, PHP_EOL, "Total strings: ", count($aStrings), PHP_EOL;
