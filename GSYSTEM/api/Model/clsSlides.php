<?php

class clsSlides
{
    private $_id_slide;
    private $_nombre_imagen;
    private $_url_imagen;
    private $_url;
    private $_estado;
    private $_id_unidad_negocio;

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


    public function getAllSlides()
    {
        $sql = "SELECT s.id_slide, s.nombre_imagen, s.url_imagen, s.url, s.estado, 
                        u.id_unidad_negocio, u.nombre as negocio
                FROM tbl_slide s
                INNER JOIN tbl_unidad_negocio u ON s.tbl_unidad_negocio_id_unidad_negocio = u.id_unidad_negocio";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getSlidesUnidad()
    {
        $sql = "SELECT s.nombre_imagen, s.url_imagen, s.url
                FROM tbl_slide s
                INNER JOIN tbl_unidad_negocio u 
                ON s.tbl_unidad_negocio_id_unidad_negocio = u.id_unidad_negocio
                WHERE u.id_unidad_negocio = ? and s.estado = 1";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_unidad_negocio"));
        $query->execute();
        return $query->fetchAll();
    }

    public function createSlides()
    {
        $sql = "INSERT INTO tbl_slide VALUES (null,?,?,?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre_imagen"));
        $query->bindValue(2, $this->__GET("_url_imagen"));
        $query->bindValue(3, $this->__GET("_url"));
        $query->bindValue(4, 1);
        $query->bindValue(5, $this->__GET("_id_unidad_negocio"));

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateSlides()
    {

        $sql = "UPDATE tbl_slide SET estado = ? WHERE id_slide = ?";

        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_estado")==1?true:false);
        $query->bindValue(2, $this->__GET("_id_slide"));

        return $query->execute();
    }

    public function deleteSlides()
    {
        $sql = "DELETE FROM tbl_slide WHERE id_slide = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_slide")));
        return $query->execute();
    }
    
}
