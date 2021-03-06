<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

$request    = explode( '/' ,  $_SERVER[ 'REQUEST_URI' ]  );
$site       = $request[ 1 ];
$server     = $_SERVER[ 'SERVER_NAME' ];
$url_server = "http://{$server}";
$url        = "{$url_server}/{$site}/";

//Essential files to go!
include_once 'controller/functions.php';
include_once 'controller/connect.php';
include_once 'model/model.php';


//Essential constants
define( "URL_SERVER", $url_server                );
define( "URL_SITE" ,  $url                       );
define( "PATH_SITE",  dirname(__FILE__) . '/'    );
define( "SITE_NAME",  $site                      );

//DATABASE CONFIG
define( "DB_HOST",      '127.0.0.1'         );
define( "DB_BASE",      'partner-fusion'    );
define( "DB_USER",      'root'              );
define( "DB_PASSWORD",  ''                  );

//Default timezone for time function
date_default_timezone_set( 'America/Sao_Paulo' );


$controller = new Functions();
$controller->check_access();


function autoload( $class )
{
    $class = explode('_', strtolower($class) );
    list($folder, $module) = $class;
    $file = "{$folder}/{$folder}-{$module}.php";

    if ( file_exists( $file ) ) {
        include_once $file;
    }
}

spl_autoload_register( 'autoload' );


function dump( $var )
{
    echo '<pre>';
    var_dump( $var );
    exit;
}