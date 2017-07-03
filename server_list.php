<?php
/*
 * server => MySQL
 * sqlite => SQLite 3
 * sqlite2 => SQLite 2
 * pgsql => PostgreSQL
 * oracle => Oracle
 * mssql => MS SQL
 * firebird => Firebird (alpha)
 * simpledb => SimpleDB
 * mongo => MongoDB (beta)
 * elastic => Elasticsearch (beta)
 *
 */
$SERVER_LIST = array(
    'Fivel [Python dev]'=> array('ip'=>'148.251.99.194:15432', 'driver'=>'pgsql'),
    'Fivel blue [Python dev]'=> array('ip'=>'148.251.99.194:15433', 'driver'=>'pgsql'),
    'Database Pg [local]'=> array('ip'=>'172.17.0.1:5432', 'driver'=>'pgsql'),
    'Database Mysql [local]'=> array('ip'=>'172.17.0.1:3306', 'driver'=>'server'),
    'FurnitureCrm [Prod]'=> array('ip'=>'5.63.154.238:3306', 'driver'=>'server'),
    'Fivel [Prod]'=> array('ip'=>'138.201.48.58:5432', 'driver'=>'pgsql'),
);
