<?php
namespace Core\Database;
use Core\Database\QueryBuilder;
use Core\Database\ConnectDB;


$connect_DB = new query_builder(connector::connect($config['database_env']));
