<?php
if (!function_exists('datenullchecker')) {
    function datenullchecker($date)
    {
        if (empty($date) || $date == '1900-01-01') {
            return null;
        }
        return $date;
    }
}
?>