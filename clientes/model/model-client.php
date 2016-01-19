<?php

class Model_client extends Connect
{
    public function __construct() {
        parent::__construct();
    }

    public function insert_client( $data )
    {
        $query = "INSERT INTO clients ( client_name , client_branch, client_phone , client_register_date )
                  VALUES ( :client_name , :client_branch, :client_phone , :register_date ) ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_name' , $data[ '_name' ] );
            $stm->bindParam( ':client_branch' , $data[ '_branch' ] );
            $stm->bindParam( ':client_phone' , $data[ '_phone' ] );
            $stm->bindParam( ':register_date' , $data[ '_register_date' ] );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function get_client( $id )
    {
        $query = "SELECT * FROM clients WHERE client_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function get_clients()
    {
        $query = "SELECT * FROM clients ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function update_client( $data )
    {
        $query = "UPDATE clients SET client_name = :client_name , client_branch = :client_branch , client_phone = :client_phone
                  WHERE client_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':client_name'   , $data[ '_name' ] );
            $stm->bindParam( ':client_branch' , $data[ '_branch' ] );
            $stm->bindParam( ':client_phone'  , $data[ '_phone' ] );
            $stm->bindParam( ':id'            , $data[ '_id' ] , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function in_order( $id )
    {
        $query = "SELECT order_id FROM orders WHERE client_id = :id ";

        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function delete_order( $id )
    {
        $query = "DELETE FROM orders WHERE client_id = :id ";

        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function delete_client( $id )
    {
        $query = "DELETE FROM clients WHERE client_id = :id ";

        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }
}