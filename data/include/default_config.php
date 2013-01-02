<?php
/**
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */

require_once 'entities/test.php';
//require_once 'entities/report.php';
//require_once 'entities/value.php';
require_once 'entities/variable.php';

$treat_entities = array();
$treat_entities['test'] = new TestEntity();
//$treat_entities['report'] = new ReportEntity();
//$treat_entities['value'] = new ValueEntity();
$treat_entities['variable'] = new VariableEntity();

