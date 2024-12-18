<?php
 session_start();
 date_default_timezone_set('Asia/Calcutta');
 define("BASE_PATH",dirname(dirname(__FILE__)));
 define("BASE_URL",'http://localhost/php/online_grocery_store');
 

 include_once(__DIR__."/connection.php");