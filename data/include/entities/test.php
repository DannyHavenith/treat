<?php
/**
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */
require_once 'entity.php';

class TestEntity {
   
    
    function get( PDO $db, array $query)
    {
        if (count( $query) >= 2)
        {
            $key = $query[1];
            return $this->fetch_single( $db, $key);
        }
        else {
            return $this->fetch_list( $db);
        }
    }
    
    function fetch_single( PDO $db, $key)
    {
        $statement = $db->prepare("SELECT * from test where id = ?");
        $statement->execute( array( $key));
        if ($test = $statement->fetchObject())
        {
            $test->variables = $this->fetch_associated( $db, 'variable', 'test_id', $key);
        }
        return $test;
    }
    
    function fetch_associated( PDO $db, $table, $foreign_key, $key_value)
    {
        $statement = $db->prepare( "SELECT * from $table WHERE $foreign_key = ?");
        $statement->execute( array( $key_value));
        return $statement->fetchAll( PDO::FETCH_OBJ);
    }
    
    function fetch_list( PDO $db)
    {
        $fetch_variables = $db->prepare( "SELECT * from variable WHERE test_id = ?");
        $fetch_tests = $db->query('SELECT * from test');
        $tests = $fetch_tests->fetchAll( PDO::FETCH_OBJ);
        
        foreach ($tests as &$test) {
            $fetch_variables->execute(  array( $test->id));
            $test->variables = $fetch_variables->fetchAll( PDO::FETCH_OBJ);
        }
        
        return $tests;
    }
    
}