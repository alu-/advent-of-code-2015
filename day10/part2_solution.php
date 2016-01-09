<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$sInput = file_get_contents(realpath(__DIR__) . '/part2_input.txt');

for( $i = 1; $i <= 50; ++$i ) {
	$sInput = preg_replace_callback('/(.)\1*/', function($aMatches) {
		return strlen($aMatches[0]) . $aMatches[1];
	}, $sInput);
}

echo strlen($sInput);
