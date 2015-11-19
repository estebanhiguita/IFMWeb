<?php

class clsProducto
{
    private $_id_prducto;
    private $_id_galeria;
    private $_nombre;
    private $_descripcion;
    private $_oferta;
    private $_destacado;
    private $_url;
    private $_id_marca;
    private $_estado;
    private $_precio;
    private $_porcentaje_oferta;
    private $_tipo_producto;

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


    /**
     * Get all songs from database
     */
    public function getAllProductoxMarca()
    {
        $sql = "SELECT p.id_producto, p.nombre, p.precio, p.url 
                FROM tbl_producto p 
                WHERE p.destacado = 1 and p.tbl_marca_id_marca = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_marca"));
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllProductoAllxMarca()
    {
        $sql = "SELECT p.tipo_producto, p.id_producto, p.nombre, p.descripcion, p.oferta, p.precio, p.destacado, p.porcentaje_oferta, p.url, p.tbl_marca_id_marca as id_marca, p.estado, m.nombre as marca, m.url as url_marca 
                FROM tbl_producto p INNER JOIN tbl_marca m ON p.tbl_marca_id_marca = m.id_marca WHERE m.id_marca = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_marca"));
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllProductosOferta()
    {
        $sql = "SELECT p.tipo_producto, p.id_producto, p.nombre, p.descripcion, p.oferta, p.precio, p.destacado, p.porcentaje_oferta, p.url, p.tbl_marca_id_marca as id_marca, p.estado, m.nombre as marca 
                FROM tbl_producto p INNER JOIN tbl_marca m ON p.tbl_marca_id_marca = m.id_marca WHERE p.oferta = 1";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllProducto()
    {
        $sql = "SELECT p.tipo_producto, p.id_producto, p.nombre, p.descripcion, p.oferta, p.precio, p.destacado, p.porcentaje_oferta, p.url, p.tbl_marca_id_marca as id_marca, p.estado, m.nombre as marca 
                FROM tbl_producto p INNER JOIN tbl_marca m ON p.tbl_marca_id_marca = m.id_marca";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllProductoServidor()
    {
        $sql = "SELECT p.tipo_producto, p.id_producto, p.nombre, p.descripcion, p.oferta, p.precio, p.destacado, p.porcentaje_oferta, p.url, p.tbl_marca_id_marca as id_marca, p.estado, m.nombre as marca 
                FROM tbl_producto p INNER JOIN tbl_marca m ON p.tbl_marca_id_marca = m.id_marca
                WHERE p.tipo_producto = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_tipo_producto"));
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllGaleriaProducto()
    {
        $sql = "SELECT id_galeria, url_imagen, estado FROM tbl_galeria WHERE tbl_producto_id_producto = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_producto"));
        $query->execute();
        return $query->fetchAll();
    }

    public function getAllGaleriaProductoActivo()
    {
        $sql = "SELECT tg.id_galeria, tg.url_imagen, tp.nombre, tp.descripcion, tp.precio FROM tbl_galeria as tg INNER JOIN tbl_producto as tp ON tg.tbl_producto_id_producto = tp.id_producto WHERE tg.tbl_producto_id_producto = ? and tg.estado = 1";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, $this->__GET("_id_producto"));
        $query->execute();
        return $query->fetchAll();
    }

    public function createProducto()
    {
        $sql = "INSERT INTO tbl_producto VALUES (null,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_descripcion"));
        $query->bindValue(3, $this->__GET("_oferta")==1?true:false);
        $query->bindValue(4, $this->__GET("_precio"));
        $query->bindValue(5, $this->__GET("_destacado")==1?true:false);
        $query->bindValue(6, $this->__GET("_porcentaje_oferta"));
        $query->bindValue(7, $this->__GET("_url"));
        $query->bindValue(8, 1);
        $query->bindValue(9, $this->__GET("_id_marca"));
        $query->bindValue(10, $this->__GET("_tipo_producto"));

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateProducto($bEstado, $bImage)
    {
        if($bEstado != 1){

            $sql = "UPDATE tbl_producto SET estado = ? WHERE id_producto = ?";
            $query = $this->db->prepare($sql);

            $query->bindValue(1, $this->__GET("_estado")==1?true:false);
            $query->bindValue(2, $this->__GET("_id_producto"));


        }else{

            if($bImage == 0){

                $sql = "UPDATE tbl_producto SET nombre = ?, descripcion = ?, oferta = ?, precio = ?, destacado = ?, porcentaje_oferta=?, tbl_marca_id_marca = ?, tipo_producto = ?  WHERE id_producto = ?";
                $query = $this->db->prepare($sql);

                $query->bindValue(1, $this->__GET("_nombre"));
                $query->bindValue(2, $this->__GET("_descripcion"));
                $query->bindValue(3, $this->__GET("_oferta")==1?true:false);
                $query->bindValue(4, $this->__GET("_precio"));
                $query->bindValue(5, $this->__GET("_destacado")==1?true:false);
                $query->bindValue(6, $this->__GET("_porcentaje_oferta"));
                $query->bindValue(7, $this->__GET("_id_marca"));
                $query->bindValue(8, $this->__GET("_tipo_producto"));
                $query->bindValue(9, $this->__GET("_id_producto"));

            }else{

                $sql = "UPDATE tbl_producto SET nombre = ?, descripcion = ?, oferta = ?, precio = ?, destacado = ?, porcentaje_oferta=?, url = ?, tbl_marca_id_marca = ?, tipo_producto = ?  WHERE id_producto = ?";
                $query = $this->db->prepare($sql);

                $query->bindValue(1, $this->__GET("_nombre"));
                $query->bindValue(2, $this->__GET("_descripcion"));
                $query->bindValue(3, $this->__GET("_oferta")==1?true:false);
                $query->bindValue(4, $this->__GET("_precio"));
                $query->bindValue(5, $this->__GET("_destacado")==1?true:false);
                $query->bindValue(6, $this->__GET("_porcentaje_oferta"));
                $query->bindValue(7, $this->__GET("_url"));
                $query->bindValue(8, $this->__GET("_id_marca"));
                $query->bindValue(9, $this->__GET("_tipo_producto"));
                $query->bindValue(10, $this->__GET("_id_producto"));
            }

        }

        return $query->execute();
    }


    public function ultimoId()
    {
        $sql = "SELECT max(id_producto) as max FROM tbl_producto";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch()->max;
    }


    public function GuardarGaleria()
    {
        $sql = "INSERT INTO tbl_galeria VALUES (null,?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_url"));
        $query->bindValue(2, 1);
        $query->bindValue(3, $this->__GET("_id_producto"));

        return $query->execute();
    }

    public function updateGaleriaProducto()
    {
        $sql = "UPDATE tbl_galeria SET estado = ? WHERE id_galeria = ?";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_estado")==1?true:false);
        $query->bindValue(2, $this->__GET("_id_galeria"));
        
        return $query->execute();
    }

    public function deleteGaleria()
    {
        $sql = "DELETE FROM tbl_galeria WHERE id_galeria = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_galeria")));
        return $query->execute();
    }

    public function deleteProducto()
    {
        $sql = "DELETE FROM tbl_producto WHERE id_producto = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_producto")));
        return $query->execute();
    }
    
}
