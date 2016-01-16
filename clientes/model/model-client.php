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
            die( $e->getMessage() );
        }
    }
}