<?php

/**
 * @param $value
 */
function get_clear_field($value)
{
    if (empty(trim($value))) {
        return '';
    }
    return preg_replace("/[^0-9]/", "", $value);
}

/**
 * @param $param
 * @return int|string|null
 */
function convert_string_to_date($param)
{
    if (empty($param)) {
        return null;
    }
    try {
        list($day, $month, $year) = explode('/', $param);
        $dateFormat = $year . '-' . $month . '-' . $day;
        return (new \DateTime($dateFormat))->format('Y-m-d');
    } catch (Exception $e) {
        return null;
    }
}
