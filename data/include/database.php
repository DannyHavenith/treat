<?php
function open_database( array $options) 
{
    $db = $options['dbdsn'];
    $user = $options['dbusername'];
    $password = $options['dbpassword'];
    $db = new PDO( $db, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}