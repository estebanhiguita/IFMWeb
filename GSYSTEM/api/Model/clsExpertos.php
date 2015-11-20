<?php

class clsExpertos
{
    private $_id_expertos;
    private $_nombre;
    private $_url;
    private $_profesion;
    private $_cargo;
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



    public function getAllExpertos()
    {
        $sql = "SELECT * FROM tbl_expertos";
        $query = $this->db->prepare($sql);
        if ($query->execute() ){
//            var_dump ($query);
        }
        return $query->fetchAll();
    }


    public function createExpertos()
    {
        $sql = "INSERT INTO tbl_expertos VALUES (null,?,?,?,?,?)";
        $query = $this->db->prepare($sql);

        $query->bindValue(1, $this->__GET("_nombre"));
        $query->bindValue(2, $this->__GET("_url"));
        $query->bindValue(3, $this->__GET("_profesion"));
        $query->bindValue(4, $this->__GET("_cargo"));
        $query->bindValue(5, $this->__GET("_estado"));
        

        return $query->execute();
    }

    // $bEstado si llega un numero diferente a 1 se modificara el estado
    public function updateExpertos($bEstado, $bImage)
    {
        if($bEstado != 1){

            $sql = "UPDATE tbl_expertos SET estado = ? WHERE id_expertos = ?";
            $query = $this->db->prepare($sql);

            $query->bindValue(1, $this->__GET("_estado")==1?true:false);
            $query->bindValue(2, $this->__GET("_id_expertos"));


        }else{

            if($bImage == 0){

                $sql = "UPDATE tbl_expertos SET nombre = ?,  profesion = ?, cargo = ? WHERE id_expertos = ?";
                $query = $this->db->prepare($sql);
                        $query->bindValue(1, $this->__GET("_nombre"));
                        $query->bindValue(3, $this->__GET("_profesion"));
                        $query->bindValue(4, $this->__GET("_cargo"));
                        $query->bindValue(6, $this->__GET("_id_expertos"));

            }else{

      $sql = "UPDATE tbl_expertos SET nombre = ?, nombre = ?,  profesion = ?, cargo = ?, url = ? WHERE id_expertos = ?";
                $query = $this->db->prepare($sql);
                        $query->bindValue(1, $this->__GET("_nombre"));
                        $query->bindValue(3, $this->__GET("_profesion"));
                        $query->bindValue(4, $this->__GET("_cargo"));
                        $query->bindValue(6, $this->__GET("_id_expertos"));
                        $query->bindValue(5, $this->__GET("_url"));
                        $query->bindValue(7, $this->__GET("_id_expertos"));
            }

        }

        return $query->execute();
    }


    public function deleteExpertos()
    {
        $sql = "DELETE FROM tbl_expertos WHERE id_expertos = ?";
        $query = $this->db->prepare($sql);
        $query->bindValue(1, strip_tags($this->__GET("_id_expertos")));
        return $query->execute();
    }
    
}
