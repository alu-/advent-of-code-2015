<?php

/**
 * 
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson 
 */

$sString = file_get_contents(realpath(__DIR__) . '/part1_input.txt');
echo substr_count($sString, '(') - substr_count($sString, ')');
