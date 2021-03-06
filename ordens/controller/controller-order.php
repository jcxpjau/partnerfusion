<?php

class Controller_order extends Functions
{
    public function __construct()
    {
        parent::__construct();

        if ( isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] ) {
            include_once  PATH_SITE . 'clientes/model/model-client.php';
            include_once  PATH_SITE . 'servicos/model/model-service.php';

            if ( method_exists( $this , $_GET[ 'action' ] ) )
                $this->$_GET[ 'action' ]();
            else
                die( 'Invalid Action' );
        } else {
            $this->list_all();
            include_once 'view/view-order.php';
        }
    }

    private function insert()
    {
        $this->error = false;
        $this->msg   = false;
        $this->v = array(
            '_client_id'    => '',
            '_service_id'   => '',
            '_start'        => '',
            '_end'          => ''
        );

        $client         = new Model_client();
        $service        = new Model_service();
        $this->clients  = $client->get_clients();
        $this->services = $service->get_services();

        if ( isset( $_POST[ 'order-form' ] ) && $_POST[ 'order-form' ] ) {
            $requires = array(
                '_client_id',
                '_service_id',
                '_start',
                '_end'
            );

            $values = $this->sanitize_fields($_POST, $requires);
            if ( !$values )
                $this->error = 'Preencha todos os campos! ';
        }

        if ( isset( $values ) && $values ) {

            list( $start_d , $start_m , $start_y ) = explode( '/', $values[ '_start' ] );
            list( $end_d , $end_m , $end_y )       = explode( '/' , $values[ '_end' ] );

            $start = checkdate( $start_m , $start_d , $start_y );
            $end   = checkdate( $end_m , $end_d , $end_y );

            if ( $start && $end ) {

                $values[ '_start' ]         = implode('-', array_reverse( explode('/', $values[ '_start' ] ) ) );
                $values[ '_end' ]           = implode('-', array_reverse( explode('/', $values[ '_end' ] ) ) );

                if ( strtotime( $values[ '_start' ] ) < strtotime( $values[ '_end' ] ) ) {
                    $values[ '_register_date' ] = date( 'Y-m-d' );
                    $order = new Model_order();
                    $result = $order->insert_order( $values );
                } else {
                    $this->error = 'Data inicial não pode ser maior que a data final! ';
                }

            } else {
                $this->error = 'Data inválida! ';
            }

            if ( !isset( $result ) ) {

                if ( !$this->error )
                    $this->error = 'Não foi possível cadastrar esse trabalho!';

                $this->v = array(
                    '_client_id'    => $_POST['_client_id'],
                    '_service_id'   => $_POST['_service_id'],
                    '_start'        => $_POST['_start'],
                    '_end'          => $_POST['_end']
                );
            } else {
                $orders         = $order->get_orders();
                foreach( $orders as $key => $value ) {
                    if ( strtotime( date( 'Y-m-d') ) > strtotime( $value->order_start ) ) {
                        $rest = strtotime( $value->order_end ) - strtotime( date( 'Y-m-d' ) );
                    } else {
                        $rest = strtotime( $value->order_end ) - strtotime( $value->order_start );
                    }
                    $rest = $rest / 86400;

                    $value->rest_days = $rest;
                }
                $this->orders = $orders;

                if ( isset( $order->error ) )
                    $this->error .= $order->error;

                include_once 'view/view-order.php';
                exit;
            }

            if ( isset( $order->error ) )
                $this->error .= $order->error;
        }

        if( isset( $client->error ) )
            $this->error .= $client->error;
        if ( isset( $service->error ) )
            $this->error .= $service->error;

        include_once 'view/order-insert.php';
    }

    private function edit()
    {
        $this->error    = false;
        $this->msg      = false;
        $client         = new Model_client();
        $service        = new Model_service();
        $this->clients  = $client->get_clients();
        $this->services = $service->get_services();

        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $orderMOD  = new Model_order();
            $order     = $orderMOD->get_order( $id );
            $order     = array_shift( $order );
            if ( !$order )
                $this->error = 'Ordem não informada! ';
        }

        if ( isset( $_POST[ 'order-form' ] ) && $_POST[ 'order-form' ] ) {
            $requires = array(
                '_client_id',
                '_service_id',
                '_start',
                '_end'
            );
            $values = $this->sanitize_fields( $_POST , $requires );
            if ( !$values )
                $this->error = 'Preencha todos os campos! ';
        }

        if ( isset( $values ) && $values && isset( $id ) ) {

            $values[ '_id' ] =  (int) $id;

            list( $start_d , $start_m , $start_y ) = explode( '/', $values[ '_start' ] );
            list( $end_d , $end_m , $end_y )       = explode( '/' , $values[ '_end' ] );

            $start = checkdate( $start_m , $start_d , $start_y );
            $end   = checkdate( $end_m , $end_d , $end_y );

            if ( $start && $end ) {

                $values['_start'] = implode('-', array_reverse(explode('/', $values['_start'])));
                $values['_end']   = implode('-', array_reverse(explode('/', $values['_end'])));

                if (strtotime($values['_start']) < strtotime($values['_end'])) {

                    $result = $orderMOD->update_order($values);
                    if ($result) {
                        $this->msg = 'Trabalho editado com sucesso! ';
                        $order = $orderMOD->get_order($values['_id']);
                        $order = array_shift($order);
                    }
                } else {
                    $this->error = 'Data inicial não pode ser maior que data final! ';
                }
            } else {
                $this->error = 'Data inválida! ';
            }
        }

        if ( isset( $order ) && !empty( $order ) ) {
            $this->v = array(
                '_client_id'        => $order->client_id,
                '_service_id'       => $order->service_id,
                '_start'            => date( 'd-m-Y' , strtotime( $order->order_start ) ),
                '_end'              => date( 'd-m-Y' , strtotime( $order->order_end ) )
            );
        } else {

            if ( !$this->error )
                $this->error = 'Não foi possível gravar suas alterações! ';

            $this->v = array(
                '_client_id'    => $_POST['_client_id'],
                '_service_id'   => $_POST['_service_id'],
                '_start'        => $_POST['_start'],
                '_end'          => $_POST['_end']
            );
        }

        if ( isset( $orderMOD->error ) )
            $this->error .= $orderMOD->error;

        include_once "view/order-insert.php";
    }

    private function list_all()
    {
        $this->error = false;
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id     = (int) $_GET[ 'id' ];
            $order  = new Model_order();
            $result = $order->delete_order( $id );
            if ( !$result )
                $this->error = 'Não foi possível deletar seu trabalho!';
        }

        $order          = new Model_order();
        $orders         = $order->get_orders();

        if ( $orders ) {

            foreach ($orders as $key => $value) {
                if (strtotime(date('Y-m-d')) > strtotime($value->order_start)) {
                    $rest = strtotime($value->order_end) - strtotime(date('Y-m-d'));
                } else {
                    $rest = strtotime($value->order_end) - strtotime($value->order_start);
                }
                $rest = $rest / 86400;

                $value->rest_days = $rest;
            }
        }
        $this->orders = $orders;

        if ( isset( $order->error ) )
            $this->error .= $order->error;
    }
}