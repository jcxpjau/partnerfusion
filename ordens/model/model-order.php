<?php

class Model_order extends Connect
{
    public function __construct() {
        parent::__construct();
    }

    public function insert_order( $data )
    {
        $query = "INSERT INTO orders ( client_id , service_id, order_start , order_end, order_register_date )
                  VALUES( :client_id , :service_id , :order_start , :order_end, :order_register )";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_id',      $data[ '_client_id' ] , PDO::PARAM_INT );
            $stm->bindParam( ':service_id',     $data[ '_service_id' ] , PDO::PARAM_INT );
            $stm->bindParam( ':order_start',    $data[ '_start' ] );
            $stm->bindParam( ':order_end',      $data[ '_end' ] );
            $stm->bindParam( ':order_register', $data[ '_register_date' ] );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function update_order( $data )
    {
        $query = "UPDATE orders SET client_id = :client_id, service_id = :service_id,
                  order_start = :order_start, order_end = :order_end
                  WHERE order_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id',             $data[ '_id' ],         PDO::PARAM_INT );
            $stm->bindParam( ':client_id',      $data[ '_client_id' ],  PDO::PARAM_INT );
            $stm->bindParam( ':service_id',     $data[ '_service_id' ], PDO::PARAM_INT );
            $stm->bindParam( ':order_start',    $data[ '_start' ]                      );
            $stm->bindParam( ':order_end',      $data[ '_end' ]                        );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function get_order( $id )
    {
        $query = "SELECT * FROM orders WHERE order_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id',  $id , PDO::PARAM_INT );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function get_orders()
    {
        $query = "SELECT order_id, o.client_id, c.client_name, s.service_name, o.order_start, o.order_end, o.order_register_date
                  FROM orders o INNER JOIN clients c ON ( o.client_id = c.client_id )
                  INNER JOIN services s ON ( o.service_id = s.service_id )
                  ORDER BY c.client_name ASC";
        try {
            $stm = $this->db->prepare( $query );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function delete_order( $id )
    {
        $query = "DELETE FROM orders WHERE order_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch( PDOException $e ) {
            die( $e->getMessage() );
        }
    }
}