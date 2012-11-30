<?php
/**
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */
require_once 'encode.php';
require_once 'language.php';

/**
 * Given an error key and additional information about an error, create and encode
 * an error object that holds the error key, the additional data and a UI text for the given error.
 * @param string $error_key
 * @param array $arguments
 * @return string
 */
function encode_error( $error_key, array $arguments)
{
    $error_object = array( 
            'error_key' => $error_key,
            'arguments' => $arguments,
            'error_text' => vsprintf(  get_text( $error_key), $arguments)
            );
    
    return treat_encode( 'error', $error_object); 
}

/**
 * Exit with a translated error string
 * @param string $error_key
 * @param int $code
 * @param array $arguments
 */
function exit_error( $error_key, $code, array $arguments) 
{
    
     http_response_code( $code);
     print encode_error( $error_key, $arguments); 
     exit( ); 
}