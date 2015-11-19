<?php

class clsCasos
{
    private $_id_caso_exito;
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

    public function getAllCasos()
    {
        $sql = "SELECT m.id_caso_exito, m.nombre, m.url_imagen, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_caso_exito as m";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllCasosActive()
    {
        $sql = "SELECT m.id_caso_exito, m.nombre, m.url_imagen, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_caso_exito as m WHERE m.estado = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function createCasos()
    {
        $sql = "INSERT INTO tbl_caso_exito (nombre, url_imagen, estado) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_url"));
        $query->bindValue(3, $this->__GET("_estado"));

        return $query->execute();
    }

    public function updateCasos($bImage)
    {

        if($bImage == 0){

            $sql = "UPDATE tbl_caso_exito SET nombre = ? WHERE id_caso_exito = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_id_caso_exito"));

        }else{

            $sql = "UPDATE tbl_caso_exito SET nombre = ?, url_imagen = ? WHERE id_caso_exito = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_url"));
            $query->bindValue(3, $this->__GET("_id_caso_exito"));
        }

        return $query->execute();
    }

    public function updateEstadoCasos()
    {
        $sql = "UPDATE tbl_caso_exito SET estado = ? WHERE id_caso_exito = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, ($this->__GET("_estado") == 0 ? false : true), PDO::PARAM_BOOL);
        $query->bindValue(2, $this->__GET("_id_caso_exito"), PDO::PARAM_INT);
        return $query->execute();
    }

    public function deleteCasos()
    {
        $sql = "DELETE FROM tbl_caso_exito WHERE id_caso_exito = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_caso_exito")));
        return $query->execute();
    }
}

?>