<?php
/**
 * Helpers
 */

if (! function_exists('is_json')) {
    /**
     * Check is valid json string
     * @param $data
     * @return bool
     */
    function is_json($data)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}