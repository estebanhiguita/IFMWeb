<?php

class clsUnidadNegocio
{
    private $_id_unidad_negocio;
    private $_nombre;
    private $_url_logo;
    private $_url_video;

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
    public function getAllUnidadNegocio()
    {
        $sql = "SELECT id_unidad_negocio, nombre, url_logo, url_imagen, descripcion FROM tbl_unidad_negocio";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getVideoUnidadNegocio()
    {
        $sql = "SELECT nombre, url_logo, url_imagen, descripcion FROM tbl_unidad_negocio WHERE id_unidad_negocio = ? ";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_unidad_negocio"));
        $query->execute();
        return $query->fetchAll();
    }
    
    public function getAllUnidadNegocioActivas()
    {
        $sql = "SELECT id_unidad_negocio, nombre, url_logo, url_imagen, descripcion FROM tbl_unidad_negocio";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function updateUnidades($bImage)
    {

        if($bImage == 0){

            $sql = "UPDATE tbl_unidad_negocio SET nombre = ?, descripcion = ? WHERE id_unidad_negocio = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_url_video"));
            $query->bindValue(3, $this->__GET("_id_unidad_negocio"));

        }else{

            $sql = "UPDATE tbl_unidad_negocio SET nombre = ?, url_logo = ?, url_imagen = ?, descripcion = ? WHERE id_unidad_negocio = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_url_logo"));
            $query->bindValue(3, $this->__GET("_url_imagen"));
            $query->bindValue(4, $this->__GET("_url_video"));
            $query->bindValue(5, $this->__GET("_id_unidad_negocio"));
        }

        return $query->execute();
    }

    public function deleteUnidades()
    {
        $sql = "DELETE FROM tbl_unidad_negocio WHERE id_unidad_negocio = ?";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, strip_tags($this->__GET("_id_unidad_negocio")));

        return $query->execute();
    }
}
