<?php

class clsListaPrecio
{
    private $_id_lista_precio;
    private $_url_imagen;
    private $_estado;
    private $_url_pdf;

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

    public function getAllListaPrecio()
    {
        $sql = "SELECT id_lista_precio, url_imagen, url_pdf, estado FROM tbl_lista_precio";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getAllListaPrecioxEstado()
    {
        $sql = "SELECT id_lista_precio, url_imagen, url_pdf, estado FROM tbl_lista_precio WHERE estado = 1";
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function createListaPrecio()
    {
        $sql = "INSERT INTO tbl_lista_precio (url_imagen, url_pdf, estado) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_url_imagen"));
        $query->bindValue(2, $this->__GET("_url_pdf"));
        $query->bindValue(3, 1);

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateAllListaPrecio()
    {

        $sql = "UPDATE tbl_lista_precio SET estado = 0";
        $query = $this->db->prepare($sql);
        return $query->execute();
    }

    public function updateEstadoListaPrecio()
    {

        $sql = "UPDATE tbl_lista_precio SET estado = ? WHERE id_lista_precio = ?";

        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_estado")==1?true:false);
        $query->bindValue(2, $this->__GET("_id_lista_precio"));

        return $query->execute();
    }

    public function deleteListaPrecio()
    {
        $sql = "DELETE FROM tbl_lista_precio WHERE id_lista_precio = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_lista_precio")));
        return $query->execute();
    }
    
    
}
