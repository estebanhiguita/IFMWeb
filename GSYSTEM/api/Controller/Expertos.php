<?php
//Cmentar
class Expertos extends Controller
{
    private $mExpertos = null;

    public function __construct(){
        $this->mExpertos = $this->loadModel("clsExpertos");
    }

    public function getAllExpertos(){
        $resultado = $this->mExpertos->getAllExpertos();
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);
        //    var_dump($json);
        return $json;
    }  



    public function createExpertos($nombre, $profesion, $cargo, $file){

        $mensaje = "";
        $estado = 1;

        $this->mExpertos->__SET('_nombre', $nombre);
        $this->mExpertos->__SET('_url', $file);
        $this->mExpertos->__SET('_profesion', $profesion);
        $this->mExpertos->__SET('_cargo', $cargo);
        $this->mExpertos->__SET('_estado', $estado);
        echo $nombre;
        echo $file["name"];
        echo $profesion;
        echo $cargo;
        echo $estado;
        $target_dir = "../Admin/dist/upload/Expertos/";
        $target_file = $target_dir . $file["name"];

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if ($uploadOk != 0) 
        {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $this->mExpertos->__SET('_url', $file["name"]);
            } 
        }

        try{
            if($this->mExpertos->createExpertos()){
                echo "si esta entrando createExpertos";
                if($uploadOk==1){
                    $mensaje = "Se registró con exito!";
                }else{
                    $mensaje = "Se registro con exito, pero la imagen no se pudo almacenar en el servidor";
                }
            }else{
                echo "NO... esta entrando createExpertos";
                $mensaje = "Ocurrio un error registrando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        echo json_encode(['msj'=>$mensaje]);
    }

    public function updateExpertos($id, $nombre, $profesion, $cargo, $file){

        $mensaje = "";

        $this->mExpertos->__SET('_id_expertos', $id);
        $this->mExpertos->__SET('_nombre', $nombre);
        $this->mExpertos->__SET('_url', $file);
        $this->mExpertos->__SET('_profesion', $profesion);
        $this->mExpertos->__SET('_cargo', $cargo);

        $bImage = 0;
        $uploadOk = 1;


        if($file["name"] != ''){

            $target_dir = "../Admin/dist/upload/Expertos/";
            $target_file = $target_dir . $file["name"];


            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            if ($uploadOk != 0) {

                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    $this->mExpertos->__SET('_url', $file["name"]);
                    $bImage = 1;
                } else {

                }
            }

        }
        try{
            if($this->mExpertos->updateExpertos(1, $bImage)){
                if($uploadOk==1){
                    $mensaje = "Se modifico con exito!";
                }else{
                    $mensaje = "Se modifico con exito, pero la imagen no se pudo almacenar en el servidor";
                }
            }else{
                $mensaje = "Ocurrio un error modificando


    			";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }

    public function deleteExpertos($id){
        $this->mExpertos->__SET('_id_expertos', $id);
        $resultado = $this->mExpertos->deleteExpertos();
        return json_encode($resultado);
    }





}