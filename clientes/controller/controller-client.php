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
        $this->error = false;
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
            if ( !$values )
                $this->error = 'Preencha todos os campos! ';
        }

        if ( isset( $values ) && $values ) {
            $values[ '_register_date' ] = date( 'Y-m-d' );
            $client = new Model_client();
            $result = $client->insert_client( $values );


            if ( !$result ) {
                $this->error = 'Erro ao cadastrar cliente. Tente novamente! ';

                $this->v = array(
                    '_name'     =>  $values[ '_name' ],
                    '_branch'   =>  $values[ '_branch' ],
                    '_phone'    =>  $values[ '_phone' ]
                );
            } else {
                $this->clients = $client->get_clients();
                if ( !$this->clients )
                    $this->error = $client->error;
                include_once 'view/view-client.php';
                exit;
            }
        }
        if ( $client->error )
            $this->error .= $client->error;

        include_once "view/client-insert.php";
    }

    private function edit()
    {
        $this->error = false;
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $model  = new Model_client();
            $client = $model->get_client( $id );
            $client = array_shift( $client );
            if ( !$client )
                $this->error = 'Cliente não encontrado! ';
        }

        if ( isset( $_POST[ 'client-form' ] ) && $_POST[ 'client-form' ] ) {
            $requires = array(
                '_name',
                '_branch',
                '_phone',
            );
            $values = $this->sanitize_fields( $_POST , $requires );
            if ( !$values )
                $this->error = 'Preencha todos os campos! ';
        }

        if ( isset( $values ) && $values && isset( $id ) ) {
            $values[ '_id' ] =  (int) $id;
            $result = $model->update_client( $values );
            if ( $result ) {
                $client = $model->get_client( $values[ '_id' ] );
                $client = array_shift( $client );
            }
        }

        if ( isset( $client ) && !empty( $client ) ) {
            $this->v = array(
                '_name'      => $client->client_name,
                '_branch'    => $client->client_branch,
                '_phone'     => $client->client_phone
            );
        } else {
            $this->error = 'Ocorreu um erro ao atualizar o cliente! ';
            $this->v = array(
                '_name'      => $_POST[ '_name' ],
                '_branch'    => $_POST[ '_branch' ],
                '_phone'     => $_POST[ '_phone' ]
            );
        }

        if ( $model->error )
            $this->error .= $model->error;

        include_once "view/client-insert.php";
    }

    private function delete()
    {
        $this->error = false;
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $model = new Model_client();
            $in_order = $model->in_order( $id );
            if ( empty( $in_order ) ) {
                $delete = $model->delete_client( $id );
                if ( !$delete )
                    $this->error = 'Não foi possível deletar este cliente!';
            } else {
                $delete = $model->delete_order( $id );
                if ( $delete )
                    $delete = $model->delete_client( $id );
                else
                    $this->error = 'Não foi possível deleter este cliente!';
            }
            $client             = new Model_client();
            $this->clients      = $client->get_clients();

            if ( $model->error )
                $this->error = $model->error;
            if( $client->error )
                $this->error .= $client->error;
        } else {
            $this->error = 'Cliente não informado! ';
        }
        include_once 'view/view-client.php';
    }

    private function list_all()
    {
        $this->error        = false;
        $client             = new Model_client();
        $this->clients      = $client->get_clients();
        if ( $client->error )
            $this->error = $client->error;
    }
}