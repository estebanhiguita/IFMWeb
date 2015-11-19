<?php

class clsNiff
{

    private $_id_niff;
    private $_url_imagen;
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

    public function getAllNiff()
    {
        $sql = "SELECT id_niff, url_imagen, estado FROM tbl_niff";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getAllNiffxEstado()
    {
        $sql = "SELECT id_niff, url_imagen, estado FROM tbl_niff WHERE estado = 1";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function createNiff()
    {
        $sql = "INSERT INTO tbl_niff VALUES (null,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_url_imagen"));
        $query->bindValue(2, 1);

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateAllNiff()
    {

        $sql = "UPDATE tbl_niff SET estado = 0";
        $query = $this->db->prepare($sql);
        return $query->execute();
    }

    public function updateEstadoNiff()
    {

        $sql = "UPDATE tbl_niff SET estado = ? WHERE id_niff = ?";

        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_estado")==1?true:false);
        $query->bindValue(2, $this->__GET("_id_niff"));

        return $query->execute();
    }

    public function deleteNiff()
    {
        $sql = "DELETE FROM tbl_niff WHERE id_niff = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_niff")));
        return $query->execute();
    }
}
