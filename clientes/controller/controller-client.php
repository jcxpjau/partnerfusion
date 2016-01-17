<?php

class Controller_client extends Functions
{
    public function __construct()
    {
        parent::__construct();

        if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] ) {
            if ( method_exists( $this , $_GET[ 'action' ] ) )
                $this->$_GET[ 'action' ]();
            else
                die ( "Invalid action" );

        } else {
            $this->list_all();
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

            if ( !$result ) {
                $error = 'Erro ao cadastrar cliente. Tente novamente!';

                $this->v = array(
                    '_name'     =>  $values[ '_name' ],
                    '_branch'   =>  $values[ '_branch' ],
                    '_phone'    =>  $values[ '_phone' ]
                );
            }
        }
        include_once "view/client-insert.php";
    }

    private function edit()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $model  = new Model_client();
            $client = $model->get_client( $id );
            $client = array_shift( $client );
        }

        if ( isset( $_POST[ 'client-form' ] ) && $_POST[ 'client-form' ] ) {
            $requires = array(
                '_id',
                '_name',
                '_branch',
                '_phone',
            );
            $values = $this->sanitize_fields( $_POST , $requires );
        }

        if ( isset( $values ) && $values && isset( $id ) ) {
            $values[ '_id' ] =  (int) $id;
            $model  = new Model_client();
            $result = $model->update_client( $values );
            if ( $result ) {
                $client = $model->get_client( $values[ '_id' ] );
                $client = array_shift( $client );
            }
        }

        if ( isset( $client ) && !empty( $client ) ) {
            $this->v = array(
                '_id'        => $client->client_id,
                '_name'      => $client->client_name,
                '_branch'    => $client->client_branch,
                '_phone'     => $client->client_phone
            );
        }

        include_once "view/client-insert.php";
    }

    private function delete()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $model = new Model_client();
            $in_order = $model->in_order( $id );
            if ( !empty( $in_order ) ) {
                $delete = $model->delete_client( $id );
                if ( !$delete )
                    $error = 'Não foi possível deletar este cliente!';
            } else {
                $delete = $model->delete_order( $id );
                if ( $delete )
                    $delete = $model->delete_client( $id );
                else
                    $error = 'Não foi possível deleter este cliente!';
            }
        }
        include_once 'view/view-client.php';
    }

    private function list_all()
    {
        $client             = new Model_client();
        $this->clients      = $client->get_clients();
    }
}