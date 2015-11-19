<?php

class clsNoticia
{
    private $_id_noticia;
    private $_titulo;
    private $_descripcion;
    private $_url_imagen;
    private $_fecha_inicio;
    private $_fecha_fin;
    private $_url;

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
    public function getAllNoticia()
    {
        $sql = "SELECT id_noticia, titulo, descripcion, url_imagen, fecha_inicio, fecha_fin, estado, url FROM tbl_noticia";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllNoticiaxFecha()
    {
        $sql = "SELECT id_noticia, titulo, descripcion, url_imagen, url
                FROM tbl_noticia
                WHERE estado = 1 and CURDATE() BETWEEN fecha_inicio AND fecha_fin";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function createNoticia()
    {
        $sql = "INSERT INTO tbl_noticia VALUES (null,?,?,?,?,?,true,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_titulo"));
        $query->bindValue(2, $this->__GET("_descripcion"));
        $query->bindValue(3, $this->__GET("_url_imagen"));
        $query->bindValue(4, $this->__GET("_fecha_inicio"));
        $query->bindValue(5, $this->__GET("_fecha_fin"));
        $query->bindValue(6, $this->__GET("_url"));

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateNoticia($bImage)
    {

        if($bImage == 0){

            $sql = "UPDATE tbl_noticia SET titulo = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?, url = ? WHERE id_noticia = ?";
            $query = $this->db->prepare($sql);

            $query->bindValue(1, $this->__GET("_titulo"));
            $query->bindValue(2, $this->__GET("_descripcion"));
            $query->bindValue(3, $this->__GET("_fecha_inicio"));
            $query->bindValue(4, $this->__GET("_fecha_fin"));
            $query->bindValue(5, $this->__GET("_url"));
            $query->bindValue(6, $this->__GET("_id_noticia"));


        }else{

            $sql = "UPDATE tbl_noticia SET titulo = ?, descripcion = ?, url_imagen = ?, fecha_inicio = ?, fecha_fin = ?, url = ? WHERE id_noticia = ?";
            $query = $this->db->prepare($sql);

            $query->bindValue(1, $this->__GET("_titulo"));
            $query->bindValue(2, $this->__GET("_descripcion"));
            $query->bindValue(3, $this->__GET("_url_imagen"));
            $query->bindValue(4, $this->__GET("_fecha_inicio"));
            $query->bindValue(5, $this->__GET("_fecha_fin"));
            $query->bindValue(6, $this->__GET("_url"));
            $query->bindValue(7, $this->__GET("_id_noticia"));
        }

        return $query->execute();
    }

    public function updateEstadoNoticia()
    {
        $sql = "UPDATE tbl_noticia SET estado = ? WHERE id_noticia = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, ($this->__GET("_estado") == 0 ? false : true));
        $query->bindValue(2, $this->__GET("_id_noticia"));
        return $query->execute();
    }

    public function deleteNoticia()
    {
        $sql = "DELETE FROM tbl_noticia WHERE id_noticia = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_noticia")));
        return $query->execute();
    }

    
}
