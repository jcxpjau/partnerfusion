<?php

class Controller_client extends Functions
{
    public function __construct()
    {
        parent::__construct();

        if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] ) {
            if( method_exists( $this , $_GET[ 'action' ] ) ) {
                $this->$_GET[ 'action' ]();
                include_once "view/client-{$_GET[ 'action' ] }.php";
            } else {
                die ( "Invalid action" );
            }

        } else {

            include_once "view/view-client.php";
        }
    }

    private function insert()
    {
        $v = array(
            '_name'     =>  '',
            '_branch'   =>  '',
            '_phone'    =>  ''
        );

        if ( isset( $_POST[ 'client-form' ] ) && $_POST[ 'client-form' ] ) {
            $requires = array(
                '_name',
                '_branch',
                '_phone',
            );
            $values = $this->sanitize_fields( $_POST , $requires );
        }

        if ( isset( $values ) && $values ) {
            $values[ '_register_date' ] = date( 'Y-m-d' );
            $client = new Model_client();
            $result = $client->insert_client( $values );

            if ( !$result )
                $error = 'Erro ao cadastrar cliente!';
        }
    }
}