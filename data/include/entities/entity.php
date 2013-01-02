<?php 
/*
 ** Treat - Tool for reporting and analysis of test results
 ** Copyright (c) 2012 Danny Havenith
 ** Distributed under the Boost Software License, Version 1.0. (See
 ** accompanying file LICENSE_1_0.txt or copy at
 ** http://www.boost.org/LICENSE_1_0.txt)
 **
 */

class Entity
{

    function __construct( $name, $key, Array $nonkey_attributes, Array $related = array())
    {
        $this->name = $name;
        $this->from_clause = $name;
        $this->key = $key;
        $this->nonkey_attributes = $nonkey_attributes;
        $this->related = $related;
    }

    function register( PDO $db, array &$entities)
    {
        $this->db = $db;
        $this->entities = $entities;

        return array(
                "/$this->name" => array( &$this, 'fetch_list'),
                "/$this->name/(\\d+)" => array( &$this, 'fetch_single')
        );
    }


    function fetch_single( $key)
    {
        $fields = $this->field_list();
        $statement = $this->db->prepare("SELECT $fields FROM $this->from_clause WHERE $this->key = ?");
        $statement->execute( array( $key));
        if ($value = $statement->fetch( PDO::FETCH_ASSOC))
        {
            $this->enrich_object( $value);
        }
        return $value;
    }

    function fetch_filtered( $attribute_name, $attribute_value)
    {
        $fields = $this->field_list();
        $statement = $this->db->prepare("SELECT $fields FROM $this->from_clause WHERE $attribute_name = ?");
        $statement->execute( array( $attribute_value));
        return $statement->fetch( PDO::FETCH_ASSOC);
    }

    function fetch_list()
    {
        $fields = $this->field_list();
        $statement = $this->db->prepare("SELECT $fields FROM $this->from_clause");
        $statement->execute();
        $values = $statement->fetchAll( PDO::FETCH_ASSOC);
        foreach ($values as &$element)
        {
            $this->enrich_object( $element);
        }
        return $values;
    }

    private function field_list()
    {
        $fields = $this->nonkey_attributes;
        array_unshift($fields, $this->key);
        array_unshift($fields, "CONCAT('$this->name/', $this->key) AS link");
        return join( ',', $fields);
    }

    private function enrich_object( array &$value)
    {
        foreach ($this->related as $entitiy => $foreign_key)
        {
            $value[$entity] = $this->entities[$entity]->fetch_filtered( $foreign_key, $key);
        }
    }

    protected  $name; ///< the name of this entity in the entities table, typically also the name of the table in the database.
    protected  $key;  ///< the name of the key attribute in the database.
    protected  $nonkey_attributes; ///< all attributes of this entity, except for the key attribute.
    protected  $related; ///< a list of names of entities that have a 1-n relation (this entity:1, the others:n).
    protected  $from_clause; ///< from-clause to use in database queries, by default the entity/table name.
}

?>