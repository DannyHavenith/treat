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
 * This is the main entry to the treat tool. This script expects to be invoked with a url of the form http://<base-url>/path/to/an/entity
 * where <base-url> is the path to this script.
 * 
 */
require_once 'include/config.php';
require_once 'include/error.php';
require_once 'include/database.php';
require_once 'include/encode.php';
require_once '../externals/epiphany/src/Epi.php';

function register_entities( PDO $db, array &$entities)
{
    foreach ($entities as $name => &$entity)
    {
        $registration = $entity->register( $db, $entities);
        foreach ($registration as $regex => $callable)
        {
            getRoute()->get( $regex, $callable, true);
        }
    }
}

Epi::setPath('base', '../externals/epiphany/src');
Epi::init('route', 'api');
$database = open_database( $treat_config);
register_entities( $database, $treat_entities);
getRoute()->run( $_SERVER["PATH_INFO"]);
