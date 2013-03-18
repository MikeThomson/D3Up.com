<?php
return array('html prettyStat' => function($value, $roundTo = 2) {
	if(!$value) return '~';
	if(!is_numeric($value)) return '~';
	$val = (float) $value;
	if($val >= 1000000000000) {
		return round($val / 1000000000000, $roundTo) ."t";
	}
	if($val >= 1000000000) {
		return round($val / 1000000000, $roundTo) ."b";
	}
	if($val >= 1000000) {
		return round($val / 1000000, $roundTo) ."m";
	}
	if($val >= 1000) {
		return round($val / 1000, $roundTo) ."k";
	}
	return round($val, $roundTo);
});