customerrorlog
==============

Class to handle errors, warnings , notices, all errors displayed in the PHP code.

How to use:
	Include CustomErrorLog.php class at the beginning of the web app and it 
	already starts to record errors.
	To disconnect error handling temporarily comment the line:
	
	$el = new CustomErrorLog(); 
	
	
to the footer the page.

Automatically record data on path @pathLogs.  
$pathLogs is a variable defined at some point in your application before the call to the class

Example test class

<?php

  $rutaLogs = "/home/depruebas/wwwroot/web/files/logs/";

  require_once "CustomErrorLog.php";


  print_r ($r);
  
?>
