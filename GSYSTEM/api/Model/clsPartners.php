<?php

class clsPartners
{
    private $_id_partner;
    private $_nombre;
    private $_url;
    private $_estado;
    /**
     * @param object $db A PDO database connection
     */
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

    public function getAllPartners()
    {
        $sql = "SELECT m.id_partner, m.nombre, m.url_imagen, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_partner as m";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllPartnersActive()
    {
        $sql = "SELECT m.id_partner, m.nombre, m.url_imagen, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_partner as m WHERE m.estado = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function createPartners()
    {
        $sql = "INSERT INTO tbl_partner (nombre, url_imagen, estado) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_url"));
        $query->bindValue(3, $this->__GET("_estado"));

        return $query->execute();
    }

    public function updatePartners($bImage)
    {

        if($bImage == 0){

            $sql = "UPDATE tbl_partner SET nombre = ? WHERE id_partner = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_id_partner"));

        }else{

            $sql = "UPDATE tbl_partner SET nombre = ?, url_imagen = ? WHERE id_partner = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_url"));
            $query->bindValue(3, $this->__GET("_id_partner"));
        }

        return $query->execute();
    }

    public function updateEstadoPartners()
    {
        $sql = "UPDATE tbl_partner SET estado = ? WHERE id_partner = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, ($this->__GET("_estado") == 0 ? false : true), PDO::PARAM_BOOL);
        $query->bindValue(2, $this->__GET("_id_partner"), PDO::PARAM_INT);
        return $query->execute();
    }

    
    public function deletePartners()
    {
        $sql = "DELETE FROM tbl_partner WHERE id_partner = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_partner")));
        return $query->execute();
    }
}

?>