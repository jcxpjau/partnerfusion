<?php

class Controller_service extends Functions
{
    public function __construct()
    {
        parent::__construct();

        if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] ) {
            if ( method_exists( $this , $_GET[ 'action' ] ) )
                $this->$_GET[ 'action' ]();
            else
                die( 'Invalid action' );
        } else {
            $this->list_all();
            include_once 'view/view-service.php';
        }
    }

    private function insert()
    {
        $this->v = array(
            '_name'     =>  '',
            '_resume'   =>  ''
        );

        if ( isset( $_POST[ 'service-form' ] ) && $_POST[ 'service-form' ] ) {
            $requires = array(
                '_name',
                '_resume'
            );
            $values = $this->sanitize_fields( $_POST , $requires );
        }

        if ( isset( $values ) && $values ) {
            $values[ '_register_date' ] = date( 'Y-m-d' );
            $service = new Model_service();
            $result = $service->insert_service( $values );

            if ( !$result ) {
                $error = 'Erro ao cadastrar serviço. Tente novamente!';

                $this->v = array(
                    '_name'     =>  $values[ '_name' ],
                    '_resume'   =>  $values[ '_resume' ]
                );
            } else {
                $this->services = $service->get_services();
                include_once 'view/view-service.php';
                exit;
            }
        } else {
            $this->v = array(
                '_name'     =>  $_POST[ '_name' ],
                '_resume'   =>  $_POST[ '_resume' ]
            );
        }
        include_once "view/service-insert.php";
    }

    private function edit()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $serviceMOD  = new Model_service();
            $service     = $serviceMOD->get_service( $id );
            $service     = array_shift( $service );
        }

        if ( isset( $_POST[ 'service-form' ] ) && $_POST[ 'service-form' ] ) {
            $requires = array(
                '_name',
                '_resume'
            );
            $values = $this->sanitize_fields( $_POST , $requires );
        }

        if ( isset( $values ) && $values && isset( $id ) ) {
            $values[ '_id' ] =  (int) $id;
            $result = $serviceMOD->update_service( $values );
            if ( $result ) {
                $service = $serviceMOD->get_service( $values[ '_id' ] );
                $service = array_shift( $service );
            }
        }

        if ( isset( $service ) && !empty( $service ) ) {
            $this->v = array(
                '_name'         => $service->service_name,
                '_resume'       => $service->service_resume
            );
        } else {
            $this->v = array(
                '_name'         => $_POST[ '_name' ],
                '_resume'       => $_POST[ '_resume' ]
            );
        }

        include_once "view/service-insert.php";
    }

    private function delete()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $serviceMOD = new Model_service();
            $in_order = $serviceMOD->in_order( $id );
            if ( empty( $in_order ) ) {
                $delete = $serviceMOD->delete_service( $id );
                if ( !$delete )
                    $error = 'Não foi possível deletar este serviço!';
            } else {
                $delete = $serviceMOD->delete_order( $id );
                if ( $delete )
                    $delete = $serviceMOD->delete_service( $id );
                else
                    $error = 'Não foi possível deleter este serviço!';
            }
            $services       = new Model_service();
            $this->services = $services->get_services();
        }
        include_once 'view/view-service.php';
    }

    private function list_all()
    {
        $services       = new Model_service();
        $this->services = $services->get_services();
    }

}