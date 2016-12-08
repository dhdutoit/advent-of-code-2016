<?php

$input = explode(',','L5, R1, L5, L1, R5, R1, R1, L4, L1, L3, R2, R4, L4, L1, L1, R2, R4, R3, L1, R4, L4, L5, L4, R4, L5, R1, R5, L2, R1, R3, L2, L4, L4, R1, L192, R5, R1, R4, L5, L4, R5, L1, L1, R48, R5, R5, L2, R4, R4, R1, R3, L1, L4, L5, R1, L4, L2, L5, R5, L2, R74, R4, L1, R188, R5, L4, L2, R5, R2, L4, R4, R3, R3, R2, R1, L3, L2, L5, L5, L2, L1, R1, R5, R4, L3, R5, L1, L3, R4, L1, L3, L2, R1, R3, R2, R5, L3, L1, L1, R5, L4, L5, R5, R2, L5, R2, L1, L5, L3, L5, L5, L1, R1, L4, L3, L1, R2, R5, L1, L3, R4, R5, L4, L1, R5, L1, R5, R5, R5, R2, R1, R2, L5, L5, L5, R4, L5, L4, L4, R5, L2, R1, R5, L1, L5, R4, L3, R4, L2, R3, R3, R3, L2, L2, L2, L1, L4, R3, L4, L2, R2, R5, L1, R2');

// Testing combinations
//$input = explode(',','R2, L3');
//$input = explode(',','R2, R2, R2');
//$input = explode(',', 'R5, L5, R5, R3'); //12
//$input = explode(',', 'L5, R1, L5'); //11
//$input = explode(',', 'L5, R1, L5, L1, R5, R1, R1, L4'); //19
//$input = explode(',', 'L5, R1, L5, L1, R5, R1, R1'); //15
//$input = explode(',', 'L5, R1, L5, L1, R5, R1, R1, L4, L1, L3'); //20

$hq = [];
$hq = howFarIsTheEvilBunny($input);

$shortestDistance = abs(0 - $hq[0][0]) + abs(0 - $hq[0][1]);

printf("shortest distance is " . $shortestDistance . " blocks\n");

function howFarIsTheEvilBunny($elvishMap) 
{
	$theBeginning = [0,0];
	$bunnyHQEstimation = [0,0];
	$direction = 'n';

	$theGrid = [];
	$firstDouble = [];

	array_walk($elvishMap, function ($block) use (&$direction, &$bunnyHQEstimation, &$theGrid, &$firstDouble) {
		$turning = trim($block)[0];
		$distance = substr(trim($block), 1);

		if ($direction == 'n' && $turning == 'L') {
			$bunnyHQEstimation[0] -= $distance;
			$direction = 'w';
		} else if ($direction == 'n' && $turning == 'R') {
			$bunnyHQEstimation[0] += $distance;
			$direction = 'e';
		} else if ($direction == 's' && $turning == 'L') {
			$bunnyHQEstimation[0] += $distance;
			$direction = 'e';
		} else if ($direction == 's' && $turning == 'R') {
			$bunnyHQEstimation[0] -= $distance;
			$direction = 'w';
		} else if ($direction == 'e' && $turning == 'L') {
			$bunnyHQEstimation[1] += $distance;
			$direction = 'n';
		} else if ($direction == 'e' && $turning == 'R') {
			$bunnyHQEstimation[1] -= $distance;
			$direction = 's';

		} else if ($direction == 'w' && $turning == 'L') {
			$bunnyHQEstimation[1] -= $distance;
			$direction = 's';
		} else if ($direction == 'w' && $turning == 'R') {
			$bunnyHQEstimation[1] += $distance;
			$direction = 'n';
		}
	});

	return [$bunnyHQEstimation, $firstDouble];
}