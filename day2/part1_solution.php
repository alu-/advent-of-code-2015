<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aBoxes = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES);
$iTotalSurfaceArea = 0;
$iLength = $iWidth = $iHeight = 0;
foreach( $aBoxes as $sRawDimensions ) {
	list($iLength, $iWidth, $iHeight) = explode('x', $sRawDimensions);

	$iSurfaceAreaFaceX = $iWidth * $iHeight;
	$iSurfaceAreaFaceY = $iLength * $iWidth;
	$iSurfaceAreaFaceZ = $iHeight * $iLength;

	$iTotalSurfaceArea += (2 * $iSurfaceAreaFaceX) + (2 * $iSurfaceAreaFaceY) + (2 * $iSurfaceAreaFaceZ) + min(array(
		$iSurfaceAreaFaceX,
		$iSurfaceAreaFaceY,
		$iSurfaceAreaFaceZ
	));
}

echo $iTotalSurfaceArea;
