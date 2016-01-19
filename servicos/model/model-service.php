<?php

class Model_service extends Connect
{
    public function __construct() {
        parent::__construct();
    }

    public function insert_service( $data )
    {
        $query = "INSERT INTO services ( service_name , service_resume, service_register_date )
                  VALUES ( :service_name , :service_resume, :service_register_date ) ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':service_name' , $data[ '_name' ] );
            $stm->bindParam( ':service_resume' , $data[ '_resume' ] );
            $stm->bindParam( ':service_register_date' , $data[ '_register_date' ] );
            $result = $stm->execute();
            return $result;
        } catch( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function in_order( $id )
    {
        $query = "SELECT order_id FROM orders WHERE service_id = :id ";

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
        $query = "DELETE FROM orders WHERE service_id = :id ";

        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function update_service( $data )
    {
        $query = "UPDATE services SET service_name = :service_name , service_resume = :service_resume
                  WHERE service_id = :id ";
        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $data[ '_id' ] , PDO::PARAM_INT );
            $stm->bindParam( ':service_name' , $data[ '_name' ] );
            $stm->bindParam( ':service_resume' , $data[ '_resume' ] );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function delete_service( $id )
    {
        $query = "DELETE FROM services WHERE service_id = :id ";

        try {
            $stm = $this->db->prepare( $query );
            $stm->bindParam( ':id' , $id , PDO::PARAM_INT );
            $result = $stm->execute();
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }

    public function get_service( $id )
    {
        $query = "SELECT * FROM services WHERE service_id = :id ";
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

    public function get_services()
    {
        $query = "SELECT * FROM services";
        try {
            $stm = $this->db->prepare( $query );
            $stm->execute();
            $result = $stm->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }
}