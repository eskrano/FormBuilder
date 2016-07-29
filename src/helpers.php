<?php
/**
 * Helpers
 */

if (! function_exists('is_json')) {
    function is_json($data)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}