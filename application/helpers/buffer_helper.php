<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 1/30/19
 * Time: 8:48 PM
 */


if (!function_exists('buffer_start')) {
    function buffer_start($buffer_name) {
        if (!isset($GLOBALS['buffer'])) {
            $GLOBALS['buffer'] = array();
        }
        $buffers = (array) $GLOBALS['buffer'];
        if (!isset($buffers['stack'])) $buffers['stack'] = array();
        $stack = (array) $buffers['stack'];
        $stack[] = $buffer_name;
        $GLOBALS['buffer']['stack'] = $stack;
        ob_start();
    }
}

if (!function_exists('buffer_end')) {
    function buffer_end() {
        if (!isset($GLOBALS['buffer'])) {
            $GLOBALS['buffer'] = array();
        }
        $buffers = (array) $GLOBALS['buffer'];
        if (!isset($buffers['stack'])) $buffers['stack'] = array();
        $stack = (array) $buffers['stack'];
        $last_stack = (empty($stack)) ? false : array_pop($stack);
        $output = ob_get_clean();
        if ($last_stack) {
            if (!isset($buffers[$last_stack])) $buffers[$last_stack] = array();
            $buffer_data = (array) $buffers[$last_stack];
            $buffer_data[] = $output;
            $GLOBALS['buffer'][$last_stack] = $buffer_data;
        }
        $GLOBALS['buffer']['stack'] = $stack;
        return $output;

    }
}

if (!function_exists('get_buffer_array')) {
    function get_buffer_array($buffer_name) {
        if (!isset($GLOBALS['buffer'])) {
            $GLOBALS['buffer'] = array();
        }
        $buffers = (array) $GLOBALS['buffer'];
        if (!isset($buffers[$buffer_name])) $buffers[$buffer_name] = array();
        return $buffers[$buffer_name];
    }
}

if (!function_exists('get_buffer')) {
    function get_buffer($buffer_name) {
        return implode("", get_buffer_array($buffer_name));
    }
}