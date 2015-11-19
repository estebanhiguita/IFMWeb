<?php

class clsContacto
{
    private $_id_contacto;
    private $_nombre;
    private $_telefono;
    private $_descripcion;
    private $_estado;

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
    public function getAllContacto()
    {
        $sql = "SELECT id_contacto, nombre, email, telefono, descripcion, estado, fecha FROM tbl_contacto";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


    public function createContacto()
    {
        $sql = "INSERT INTO tbl_contacto (id_contacto, nombre, email, telefono, descripcion, estado) VALUES (null,?,?,?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_email"));
        $query->bindValue(3, $this->__GET("_telefono"));
        $query->bindValue(4, $this->__GET("_descripcion"));
        $query->bindValue(5, 1);

        return $query->execute();
    }

    public function updateContacto()
    {

        $sql = "UPDATE tbl_contacto SET estado = ? WHERE id_contacto = ?";

        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_estado")==1?true:false);
        $query->bindValue(2, $this->__GET("_id_contacto"));

        return $query->execute();
    }
    
}
