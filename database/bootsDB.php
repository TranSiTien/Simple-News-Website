<?php
require 'query.php';
require 'connectDB.php';
require 'config.php';
$connect_DB = new query_builder(connector::connect(config::get_config()));
