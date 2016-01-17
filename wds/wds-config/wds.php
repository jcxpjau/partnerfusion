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
            echo json_encode( $this->clients->get_client( $_GET[ 'id' ] ) );
            exit;
        } else {
            echo json_encode( $this->clients->get_clients() );
            exit;
        }
    }

    public function print_services()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            echo json_encode( $this->services->get_service( $_GET[ 'id' ] ) );
            exit;
        } else {
            echo json_encode( $this->services->get_services() );
            exit;
        }
    }

    public function print_orders()
    {
        if ( isset( $_GET[ 'id' ] ) && $_GET[ 'id' ] ) {
            echo json_encode( $this->orders->get_order( $_GET[ 'id' ] ) );
            exit;
        } else {
            echo json_encode( $this->orders->get_orders() );
            exit;
        }
    }
}