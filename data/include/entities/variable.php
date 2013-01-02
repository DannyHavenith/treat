<?php
/*
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */
require_once 'entity.php';

class VariableEntity extends Entity 
{
     public function __construct()
     {
         parent::__construct('variable', 'id', array('name'));
     }   
}
