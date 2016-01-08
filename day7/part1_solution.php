<?php

/**
 *
 * @package advent-of-code-2015
 * @version 1
 * @author Oskar Andersson
 */

ini_set('auto_detect_line_endings', true);
$aLogic = file(realpath(__DIR__) . '/part1_input.txt', FILE_IGNORE_NEW_LINES);

$aGateWireData = array();
foreach( $aLogic as $sLogic ) {
	// Parse and store logic in an array
	$aWireData = array();
	list($sLeftData, $sOutputWire) = explode(' -> ', $sLogic);
	$aWireData = array('output' => $sOutputWire);

	// Just a provided signal and no gates
	if( ctype_digit($sLeftData) ) {
		$aWireData += array(
			'input' => (array) null,
			'type' => null,
			'output_signal' => $sLeftData,
			'provided_signal' => $sLeftData,
		);
	} else if( strpos($sLeftData, 'AND') !== false ) {
		// AND
		$aWireData += array(
			'input' => explode(' AND ', $sLeftData),
			'type' => 'AND',
			'output_signal' => null,
			'provided_signal' => null
		);
	} else if( strpos($sLeftData, 'NOT') !== false ) {
		// NOT
		$aWireData += array(
			'input' => (array) str_replace('NOT ', '', $sLeftData),
			'type' => 'NOT',
			'output_signal' => null,
			'provided_signal' => null
		);
	} else if( strpos($sLeftData, 'OR') !== false ) {
		// OR
		$aWireData += array(
			'input' => explode(' OR ', $sLeftData),
			'type' => 'OR',
			'output_signal' => null,
			'provided_signal' => null
		);
	} else if( strpos($sLeftData, 'RSHIFT') !== false ) {
		// RSHIFT
		$aWireData += array(
			'input' => explode(' RSHIFT ', $sLeftData),
			'type' => 'RSHIFT',
			'output_signal' => null,
			'provided_signal' => null
		);
	} else if( strpos($sLeftData, 'LSHIFT') !== false ) {
		// LSHIFT
		$aWireData += array(
			'input' => explode(' LSHIFT ', $sLeftData),
			'type' => 'LSHIFT',
			'output_signal' => null,
			'provided_signal' => null
		);
	} else {
		// Straight connection with no gate
		$aWireData += array(
			'input' => (array) $sLeftData,
			'type' => null,
			'output_signal' => null,
			'provided_signal' => null
		);
	}

	$aGateWireData[] = $aWireData;
}

while( true ) {
	foreach( $aGateWireData as &$aOperationData ) {
		if( $aOperationData['output_signal'] !== null ) {
			// Lookup next node that has the same input as this node outputs and exchange
			// node letters with values
			foreach( $aGateWireData as &$aNextWire ) {
				if( in_array($aOperationData['output'], (array) $aNextWire['input']) && $aNextWire['output_signal'] === null ) {
					foreach( $aNextWire['input'] as &$sNextWireInput ) {
						if( $sNextWireInput === $aOperationData['output'] ) {
							$sNextWireInput = $aOperationData['output_signal'];
						}
					}

					// Solve output if input is only integers
					if( array_filter($aNextWire['input'], 'is_numeric') === $aNextWire['input'] ) {
						switch($aNextWire['type']) {
							case 'LSHIFT':
								$aNextWire['output_signal'] = $aNextWire['input'][0] << $aNextWire['input'][1];
								break;
							
							case 'RSHIFT':
								$aNextWire['output_signal'] = $aNextWire['input'][0] >> $aNextWire['input'][1];
								break;
								
							case 'AND':
								$aNextWire['output_signal'] = $aNextWire['input'][0] & $aNextWire['input'][1];
								break;
								
							case 'OR':
								$aNextWire['output_signal'] = $aNextWire['input'][0] | $aNextWire['input'][1];
								break;
								
							case 'NOT':
								$aNextWire['output_signal'] = ~ $aNextWire['input'][0];
								break;

							case null:
								$aNextWire['output_signal'] = $aNextWire['input'][0];
								break;

							default:
								Throw new UnexpectedValueException('Unknown bitwise operation "' . $aNextWire['type'] . '"');
								break;
						}
					}
				}
			}
		}

		if($aOperationData['output'] == 'a' && $aOperationData['output_signal'] !== null ) {
			echo 'Wire a signal is ' . $aOperationData['output_signal'];
			break 2;
		}
	}
}
