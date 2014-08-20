<?php
  session_start();
  
  define('ROOT_PATH', dirname(__FILE__));
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'nfc');
  define('DB_HOST', 'localhost');
  
  define('USER', 'user');
  define('PASS', 'pass');

  date_default_timezone_set('Europe/Stockholm');  
  
  require_once(ROOT_PATH.'/includes.php');