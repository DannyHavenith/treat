<?php
/**
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */
$treat_strings = array();
$treat_language = 'english'; // we're hardcoded for English right now
require_once "language/$treat_language/core.php"; 

function get_text( $text_key )
{
    global $treat_strings;
    if (isset( $treat_strings[$text_key])) {
        return $treat_strings[$text_key];
    }
    else {
        return "!!!$text_key";
    }
}