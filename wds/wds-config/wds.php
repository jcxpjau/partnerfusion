<?php

class Wds
{
    public function __construct()
    {
        //DATABASE CONFIG
        define( "DB_HOST",      '127.0.0.1'         );
        define( "DB_BASE",      'partner-fusion'    );
        define( "DB_USER",      'root'              );
        define( "DB_PASSWORD",  ''                  );

        //Default timezone for time function
        date_default_timezone_set( 'America/Sao_Paulo' );

        include_once '../../controller/connect.php';
        include_once '../../clientes/model/model-client.php';
        include_once '../../servicos/model/model-service.php';
        include_once '../../ordens/model/model-order.php';

        $this->clients  = new Model_client();
        $this->services = new Model_service();
        $this->orders   = new Model_order();
    }

    public function print_clients()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            echo json_encode( $this->clients->get_client( $id ) );
            exit;
        } else {
            echo json_encode( $this->clients->get_clients() );
            exit;
        }
    }

    public function print_services()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            echo json_encode( $this->services->get_service( $id ) );
            exit;
        } else {
            echo json_encode( $this->services->get_services() );
            exit;
        }
    }

    public function print_orders()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            $id = (int) $_GET[ 'id' ];
            $order = $this->orders->get_order( $id );
            $order = array_shift( $order );
            if ( strtotime( date( 'Y-m-d') ) > strtotime( $order->order_start ) ) {
                $rest = strtotime( $order->order_end ) - strtotime( date( 'Y-m-d' ) );
            } else {
                $rest = strtotime( $order->order_end ) - strtotime( $order->order_start );
            }
            $rest = $rest / 86400;
            $order->rest_days = $rest;

            echo json_encode( $order );
            exit;

        } else {

            $orders = $this->orders->get_orders();
            foreach( $orders as $key => $value ) {
                if ( strtotime( date( 'Y-m-d') ) > strtotime( $value->order_start ) ) {
                    $rest = strtotime( $value->order_end ) - strtotime( date( 'Y-m-d' ) );
                } else {
                    $rest = strtotime( $value->order_end ) - strtotime( $value->order_start );
                }
                $rest = $rest / 86400;

                $value->rest_days = $rest;
            }
            echo json_encode( $value );
            exit;
        }
    }
}