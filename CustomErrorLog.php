<?php

/**
*   Class to handle errors, warnings , notices, all errors displayed in the PHP code.
*
*   How to use:
*       Include CustomErrorLog.php class at the beginning of the web app and it 
*       already starts to record errors.
*       To disconnect error handling temporarily comment the line $el = new CustomErrorLog(); 
*       to the footer
*
*
*    Automatically record data on path @pathLogs.  
*    $pathLogs is a variable defined at some point in your application before the call to the class
*
*
* @autor         Alex A. Solano ( asolano@depruebas.com )
* @link          
* @package       CErrorLog.php
* @since         v.0.1
*/

class CustomErrorLog
{

  protected $pathLogs = null;

  function __construct()
  {
    global $rutaLogs;

    $this->pathLogs = $rutaLogs;

    set_error_handler( array( &$this, 'customError'));
    register_shutdown_function( array( &$this, 'CatchFatalError'));

  }

  private function FriendlyErrorType($type)
  {
    switch($type)
    {
      case E_ERROR: // 1 //
          return 'E_ERROR';
      case E_WARNING: // 2 //
          return 'E_WARNING';
      case E_PARSE: // 4 //
          return 'E_PARSE';
      case E_NOTICE: // 8 //
          return 'E_NOTICE';
      case E_CORE_ERROR: // 16 //
          return 'E_CORE_ERROR';
      case E_CORE_WARNING: // 32 //
          return 'E_CORE_WARNING';
      case E_CORE_ERROR: // 64 //
          return 'E_COMPILE_ERROR';
      case E_CORE_WARNING: // 128 //
          return 'E_COMPILE_WARNING';
      case E_USER_ERROR: // 256 //
          return 'E_USER_ERROR';
      case E_USER_WARNING: // 512 //
          return 'E_USER_WARNING';
      case E_USER_NOTICE: // 1024 //
          return 'E_USER_NOTICE';
      case E_STRICT: // 2048 //
          return 'E_STRICT';
      case E_RECOVERABLE_ERROR: // 4096 //
          return 'E_RECOVERABLE_ERROR';
      case E_DEPRECATED: // 8192 //
          return 'E_DEPRECATED';
      case E_USER_DEPRECATED: // 16384 //
          return 'E_USER_DEPRECATED';
    }
    return "";
  } 

  public function customError($errno, $errstr, $errfile, $errline)
  {

    $error = error_get_last();
    $debug = debug_backtrace();
  
    $txterror = "[" . date('Y-m-d H:i:s') . "] - " . $errno ." -  ".$errstr." - ".$errfile." - Linea: ".$errline."\n";

    error_log( $txterror, 3, $this->pathLogs."error.log");

    if ( isset( $debug[2]))
    {
      $referer = "referer: ".$debug[2]['file']." - Linea: ".$debug[2]['line']."\n";
      error_log( $referer, 3, $this->pathLogs."error.log");
    }

  }

  public function CatchFatalError() 
  {

    $error = error_get_last();

    if ( !empty($error))
    {
      $error['typeMs'] = $this->FriendlyErrorType( $error['type']);

      $txt = "[".date('Y-m-d H:i:s')."] ".$error['type']." - ".$error['typeMs']." - ".$error['message']." - ".$error['file']." - Linea: ".$error['line']."\n";

      error_log( $txt, 3, $this->pathLogs."error.log");

    }

  }

}
	
/**
* 
*   Start class Errors.
*/
$el = new CustomErrorLog();
	

?>