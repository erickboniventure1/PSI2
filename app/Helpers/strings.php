<?php

/**
 * Check if value isset and not empty
 */
if (!function_exists('is_set')) {

	function is_set($value = null) {
		return isset($value) && !empty($value);
	}

}

/**
 * Display an object field value or N/A
 */
if (!function_exists('display_or_na')) {

	function display_or_na($value = null, $field = null) {
		if (is_set($value)) {
			if (is_object($value) && is_set($field)) {
				$value = object_get($value, $field, 'N/A');
			}
			return $value;
		} else {
			return 'N/A';
		}
	}

}

/**
 * Display value as a currency
 */
if (!function_exists('display_currency')) {

	function display_currency($value = null) {
		if (is_set($value)) {
			return config('app.currency.display') . number_format($value, 2);
		} else {
			return config('app.currency.display') . ' 0.0';
		}
	}

}

/**
 * Display decimal in as formatted decimal
 */
if (!function_exists('display_decimal')) {

	function display_decimal($value = null) {
		if (is_set($value)) {
			return number_format($value, 2);
		} else {
			return '0';
		}
	}
}

/**
 * Display value as integer
 */
if (!function_exists('display_int')) {

	function display_int($value = null) {
		if (is_set($value)) {
			return number_format($value, 0);
		} else {
			return '0';
		}
	}
}

/**
 * Display value as boolean
 */
if (!function_exists('display_boolean')) {

	function display_boolean($value = null, $yesLabel = 'Yes', $falseLabel = 'No') {
		if (is_set($value)) {
			return $value ? $yesLabel : $noLabel;
		} else {
			return $falseLabel;
		}
	}
}

/**
 * Display value as formatted date or N/A
 */
if (!function_exists('display_date')) {

	function display_date($value = null, $format = null) {
		if (is_set($value)) {
			$format = is_set($format) ? $format : config('app.datepicker_parse_format');
			return $value->format($format);
		} else {
			return 'N/A';
		}
	}

}

/**
 * Display value as percentage
 */
if (!function_exists('display_percentage')) {

	function display_percentage($value = 0, $total = 0) {
		if (is_set($value) && is_set($total) && $total !== 0 && $total >= $value) {
			$percentage = ($value / $total) * 100;
			return number_format($percentage, 2) . '%';
		} else {
			return '0%';
		}
	}
}

/**
 * Display nice date string
 */
 if (!function_exists('activity_date')) {

 	function activity_date($date) {
 		if(is_set($date)) {
      return \Carbon\Carbon::parse($date)->format('d M Y');
    }
    return 'null';
 	}
  
 }
 
/**
 * Decide whether staff is director
 */
 if (!function_exists('staff_type')) {

 	function staff_type($bool) {
 		if(is_set($bool)) {
      return ($bool) ? 'Director' : 'Staff';
    }
    return 'Staff';
 	}
  
 }
 
/**
 * Return ipcLeaderName
 */
 if (!function_exists('fullName')) {

 	function fullName($fname, $lname) {
 		if(is_set($fname) && is_set($lname)) {
      return $fname . " " . $lname;
    }
    return '';
 	}
  
 }