<?php
require __DIR__ . '/query_builder.php';
require __DIR__ . '/connectDB.php';

$connect_DB = new query_builder(connector::connect($config['database_env']));
