<?php

class clsSuscripcion
{
    private $_id_suscripcion;
    private $_email;

    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    
    public function __SET($atributo, $value){
        $this->$atributo = $value;
    }

    public function __GET($atributo){
        return $this->$atributo;
    }


    /**
     * Get all songs from database
     */
    public function getAllSuscripcion()
    {
        $sql = "SELECT id_suscripcion, email, fecha FROM tbl_suscripcion";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function createSuscripcion()
    {
        $sql = "INSERT INTO tbl_suscripcion (id_suscripcion, email) VALUES (null,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_email"));

        return $query->execute();
    }
    
}
