customerrorlog
==============

Class to handle errors, warnings , notices, all errors displayed in the PHP code.

Spanish version 
http://www.netveloper.com/clase-para-guardar-errores-en-php/

To use the class has to be included in our application and define a path for the error file as follows:
<pre>
   $rutaLogs = “/home/depruebas/wwwroot/web/files/logs/”;
   require_once “CustomErrorLog.php”;
</pre>
Change permissions to rutalogs 777

How to use:
Include CustomErrorLog.php class at the beginning of the web app and it already starts to record errors.
To disconnect error handling temporarily comment the line:
<pre>	
   $el = new CustomErrorLog(); 
</pre>	
	
to the footer the page.

Automatically record data on path @pathLogs.  
$pathLogs is a variable defined at some point in your application before the call to the class

Example test class
<pre>
&lt;?php

  $rutaLogs = "/home/depruebas/wwwroot/web/files/logs/";
	
  require_once "CustomErrorLog.php";


  print_r ($r);
  
?>
</pre>
How It Works

<b>set_error_handler</b>, this function can be used for defining your own way of handling errors during runtime.
In our class we have the following function defined:
<pre>
  set_error_handler( array( &$this, 'customError'));
  public function customError($errno, $errstr, $errfile, $errline)
</pre>
$errno, error number.
$errstr, error text.
$errfile, file where the error occurred.
$errline, line where the error occurred.

We use also the function
<pre>
$debug = debug_backtrace(); 
</pre>
to get the file and line where the error is.

<b>register_shutdown_function</b>, runs when you end a set script for either die, or exit an error.
In our case we define a method if the call to this function is performed by an error
<pre>
  register_shutdown_function( array( &$this, 'CatchFatalError'));
  public function CatchFatalError() 
</pre>
In this method we will get the last error generated
<pre>
  $error = error_get_last();
</pre>
