<?php

/**
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 *
 * All the  specific functions, needed to implement all the module
 * logic, should go to locallib.php.
 */

require_once(__DIR__ . '/lib/autoload.php');

defined('MOODLE_INTERNAL') || die();

function spsupapp_do_something($string) {
    return $string;
}

