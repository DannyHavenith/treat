<?php
/**
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */

/**
 * This is the main entry to the treat tool. This script expects to be invoked with a url of the form http://<base-url>/?q=some/path/to/an/entity
 * The 'q' argument is used to find a suitable handler for the GET/POST request.
 * 
 */
require_once 'include/config.php';
require_once 'include/error.php';
require_once 'include/database.php';
require_once 'include/encode.php';

// determine the query argument, if none was given, assume 'tests', which will produce a list of all tests
if(isset($_GET['a'])) {
    $query = $_GET['a'];
}
else {
    $query = 'tests';
}

// create an array of all path elements. This turns a query of the form /foo/bar/filter=(a=10&&b=11) into the array
// ( 'foo', 'bar', 'filter=(a=10&&b=11)')
$query_elements = array_filter( explode( '/', $query), function ($element) { return $element != "";});

// now use the first path element to find a handler for the request.
if (count( $query_elements) >= 1 && isset( $treat_entities[$query_elements[0]])) {
    $entity = $treat_entities[$query_elements[0]];
    $database = open_database($treat_config);
    switch ($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':  $result = $entity->get( $database, $query_elements); break;
        case 'POST': $result = $entity->post( $database, $query_elements, $_POST); break;
    }
    print treat_encode('result', $result);
}
else {
    // return a 404 response.
    exit_error( 'unknown_entity', 404, array($query, implode( ', ', array_keys($treat_entities))));
}



