<?php

class clsMarcas
{
    private $_id_marca;
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

    public function getAllMarcas()
    {
        $sql = "SELECT m.id_marca, m.nombre, m.url, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_marca as m";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllMarcasActive()
    {
        $sql = "SELECT m.id_marca, m.nombre, m.url, m.estado, (CASE m.estado WHEN '0' THEN 'Inactivo' ELSE 'Activo' END) AS nombreEstado FROM tbl_marca as m WHERE m.estado = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function MarcasActivas()
    {
        $sql = "SELECT m.id_marca, m.nombre, m.url, (SELECT count(id_producto) FROM tbl_producto WHERE tbl_marca_id_marca = m.id_marca and destacado = 1) as countProducto FROM tbl_marca as m WHERE m.estado = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function createMarcas()
    {
        $sql = "INSERT INTO tbl_marca (nombre, url, estado) VALUES (?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_url"));
        $query->bindValue(3, $this->__GET("_estado"));

        return $query->execute();
    }

    public function updateMarcas($bImage)
    {

        if($bImage == 0){

            $sql = "UPDATE tbl_marca SET nombre = ? WHERE id_marca = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_id_marca"));

        }else{

            $sql = "UPDATE tbl_marca SET nombre = ?, url = ? WHERE id_marca = ?";
            $query = $this->db->prepare($sql);
            $query->bindValue(1, $this->__GET("_nombre"));
            $query->bindValue(2, $this->__GET("_url"));
            $query->bindValue(3, $this->__GET("_id_marca"));
        }

        return $query->execute();
    }

    public function updateEstadoMarcas()
    {
        $sql = "UPDATE tbl_marca SET estado = ? WHERE id_marca = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, ($this->__GET("_estado") == 0 ? false : true), PDO::PARAM_BOOL);
        $query->bindValue(2, $this->__GET("_id_marca"), PDO::PARAM_INT);
        return $query->execute();
    }

    public function deleteMarca()
    {
        $sql = "DELETE FROM tbl_marca WHERE id_marca = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_marca")));
        return $query->execute();
    }
}

?>