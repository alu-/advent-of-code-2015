<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

set_time_limit(120); // This could take a while...
$sSecretKey = file_get_contents(realpath(__DIR__) . '/part1_input.txt');
$iNumber = 0;
while (true) {
    $sHash = md5($sSecretKey . $iNumber);
    if (substr($sHash, 0, 5) === "00000") {
        break;
    }
    ++$iNumber;
}

echo 'Iteration #' . $iNumber . ': ' . $sHash;
