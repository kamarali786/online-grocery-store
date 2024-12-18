<?php
include_once("includes/config.php");
session_unset();
session_destroy();
header("location:".$adminBaseUrl."/index.php");
?>