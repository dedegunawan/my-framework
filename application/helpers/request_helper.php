<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 5/1/19
 * Time: 11:07 AM
 */


if (!function_exists('input_any')) {
    function input_any($key, $input=array('get', 'post', 'header')) {
        (in_array('get', $input) && $value = get_instance()->input->get($key))
        ||
        (in_array('post', $input) && $value = get_instance()->input->post($key))
        ||
        (in_array('header', $input) && $value = get_instance()->input->get_request_header($key, TRUE)) ;

        return $value;
    }
}
