<?php

$request = explode( '/' ,  $_SERVER[ 'REQUEST_URI' ]  );
$site    = $request[ 1 ];
$server  = $_SERVER[ 'SERVER_NAME' ];
$url     = "http://{$server}/{$site}/";


if( !isset( $_SESSION ) )
    session_start();


include_once 'controller/functions.php';
include_once 'controller/connect.php';


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


define( "URL_SITE" , $url                       );
define( "PATH_SITE", dirname(__FILE__) . '/'    );
define( "SITE_NAME", $site                      );


//DATABASE CONFIG
define( "DB_HOST",      '127.0.0.1'         );
define( "DB_BASE",      'partner-fusion'    );
define( "DB_USER",      'root'              );
define( "DB_PASSWORD",  ''                  );