<?php

class Functions
{
    public function __construct()
    {
        if( !isset( $_SESSION ) ) {
            session_start();
        }

        if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == 'logout' ) {
            unset( $_SESSION[ 'hash' ] );
            unset( $_SESSION[ 'username' ] );
            setcookie( 'hash' , null , -1 );
            include_once PATH_SITE . 'login.php';
            exit;
        }

        if ( isset( $_POST[ 'login-form' ] ) && $_POST[ 'login-form' ] ) {
            $logged = $this->login();
            if ( !$logged )
                include_once PATH_SITE . 'login.php';
        }
    }

    private function login()
    {
        $requires = array(
            '_email',
            '_pwd'
        );
        $values = $this->sanitize_fields( $_POST , $requires );

        if ( $values ) {
            $user_data = array(
                '_email'    =>  $values[ '_email' ],
                '_pwd'      =>  md5( $values[ '_pwd' ] )
            );
            $model = new Model();
            $user = $model->get_user( $user_data );
            $user = array_shift( $user );
        }

        if ( isset( $user->user_id ) && $user->user_id ) {

            $_SESSION[ 'hash' ] = base64_encode( $user->user_id );
            $_SESSION[ 'username' ] = $user->user_name;

            if ( isset( $values['_rememberme'] ) && $values[ '_rememberme' ] ) {

                $update = $model->update_hash($user->user_id, $_SESSION[ 'hash' ] );
                if ($update)
                    setcookie('hash', $_SESSION[ 'hash' ] , ( time() + ( 365 * 86400 ) ) );
            }
        }

        return ( isset( $_SESSION[ 'hash' ] ) && $_SESSION[ 'hash' ] ) ? true : false;
    }

    public function check_access()
    {
        $hash = false;
        $login = "/". SITE_NAME. "/login.php";

        if ( isset( $_SESSION[ 'hash' ] ) && $_SESSION[ 'hash' ] )
            $hash = $_SESSION[ 'hash' ];
        else if ( isset( $_COOKIE[ 'hash' ] ) && $_COOKIE[ 'hash' ] )
            $hash = $_COOKIE[ 'hash' ];

        if ( $hash ) {
            $hash   = base64_decode( $hash );
            $model  = new Model();
            $hash   = $model->validate_hash( $hash );
        }

        if( $hash && $_SERVER[ 'SCRIPT_NAME' ] == $login ) {
            include_once PATH_SITE . 'index.php';
            exit;
        }

        if ( !$hash ) {
            include_once PATH_SITE . 'login.php';
            exit;
        }
    }

    public function sanitize_fields( $data , $requires )
    {
        $error = false;
        foreach( $data as $key => $v ) {
            $values[ $key ] = trim( $v );
            if ( !$values[ $key ] && ( in_array( $key, $requires ) ) ) {
                $error = 'Preencha todos os campos';
            }
        }
        return ( !$error ) ? $values : false;
    }
}