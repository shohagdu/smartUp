<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = 'default';
$query_builder = TRUE;
error_reporting(0);
date_default_timezone_set("Asia/Dhaka");

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'shohozit_smartup_user',
	'password' => 'fwOW;sHkv=hJ',
	'database' => 'shohozit_smartup_db',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'development'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

