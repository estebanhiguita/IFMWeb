<?php

class Casos extends Controller
{
    private $mCasos = null;

    public function __construct(){
        $this->mCasos = $this->loadModel("clsCasos");
    }

    public function getAllCasos(){
        $resultado = $this->mCasos->getAllCasos();
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllCasosActive(){
        $resultado = $this->mCasos->getAllCasosActive();
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }  

    public function createCasos($nombre, $url){
        $mensaje = "";

        $this->mCasos->__SET('_nombre', $nombre);
        $this->mCasos->__SET('_estado', true);


        $target_dir = "../Admin/dist/upload/Casos/";
        $target_file = $target_dir . $url["name"];

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if (move_uploaded_file($url["tmp_name"], $target_file)) {
            $this->mCasos->__SET('_url', $url["name"]);
        }
        try{
            if($this->mCasos->createCasos()){
                if($uploadOk==1){
                    $mensaje = "Se registro con exito!";
                }else{
                    $mensaje = "Se registro con exito, pero la imagen no se pudo almacenar en el servidor";
                }
            }else{
                $mensaje = "Ocurrio un error registrando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        echo json_encode(['msj'=>$mensaje]);
    }

    public function updateCasos($id, $nombre, $url){

        $mensaje = "";

        $this->mCasos->__SET('_id_caso_exito', $id);
        $this->mCasos->__SET('_nombre', $nombre);

        $bImage = 0;
        $uploadOk = 1;


        if($url["name"] != ''){

            $target_dir = "../Admin/dist/upload/Casos/";
            $target_file = $target_dir . $url["name"];

            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


            if (move_uploaded_file($url["tmp_name"], $target_file)) {
                $this->mCasos->__SET('_url', $url["name"]);
                $bImage = 1;
            }
        }

        try{
            if($this->mCasos->updateCasos($bImage)){
                if($uploadOk==1){
                    $mensaje = "Se modifico con exito!";
                }else{
                    $mensaje = "Se modifico con exito, pero la imagen no se pudo almacenar en el servidor";
                }
            }else{
                $mensaje = "Ocurrio un error modificando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }

    public function updateEstadoCasos($id, $estado){

        $mensaje = "";

        $this->mCasos->__SET('_id_caso_exito', $id);
        $this->mCasos->__SET('_estado', $estado);

        try{
            if($this->mCasos->updateEstadoCasos()){
                
                $mensaje = "Se modifico el estado con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando el estado del caso de éxito";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }

    public function deleteCaso($id){
        $this->mCasos->__SET('_id_caso_exito', $id);
        $resultado = $this->mCasos->deleteCasos();
        return json_encode($resultado);
    }
    
}

?>