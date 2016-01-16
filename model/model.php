<?php

class Model extends Connect
{
    public function __construct() {
        parent::__construct();
    }

    public function get_user( $data )
    {
        $query = 'SELECT user_id FROM users WHERE user_email = :email AND user_pwd = :pwd ';
        try{
            $sth = $this->db->prepare( $query );
            $sth->bindParam( ':email', $data[ '_email' ] );
            $sth->bindParam( ':pwd', $data[ '_pwd' ] );
            $sth->execute();
            $result = $sth->fetchAll( PDO::FETCH_OBJ );
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function update_hash( $user , $hash )
    {
        $query = 'UPDATE users SET user_hash = :hash WHERE user_id = :user ';
        try{
            $sth = $this->db->prepare( $query );
            $sth->bindParam( ':hash', $hash );
            $sth->bindParam( ':user', $user , PDO::PARAM_INT);
            $result = $sth->execute();
            return $result;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    public function validate_hash( $hash )
    {
        $query = "SELECT user_id FROM users WHERE user_id  = :hash ";
        try {
            $sth = $this->db->prepare( $query );
            $sth->bindParam( ':hash' , $hash , PDO::PARAM_INT );
            $sth->execute();
            $result = $sth->fetchAll( PDO::FETCH_OBJ );
            $user = array_shift( $result );
            return ( isset( $user->user_id ) ) ? true : false;
        } catch ( PDOException $e ) {
            die( $e->getMessage() );
        }
    }
}