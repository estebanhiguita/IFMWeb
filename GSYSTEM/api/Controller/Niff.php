<?php

class Niff extends Controller
{

    private $mNiff = null;

    public function __construct(){
        $this->mNiff = $this->loadModel("clsNiff");
    }

    public function getAllNiff(){
        $resultado = $this->mNiff->getAllNiff();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllNiffxEstado(){
        $resultado = $this->mNiff->getAllNiffxEstado();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    } 

    public function createNiff($imagen){

        $mensaje = "";

        if($this->mNiff->updateAllNiff()){

            $uploadOk=0;

            $target_dir_i = "../Admin/dist/upload/Niff/";

            $target_file_image = $target_dir_i . $imagen["name"];

            if (move_uploaded_file($imagen["tmp_name"], $target_file_image)) {
                $this->mNiff->__SET('_url_imagen', $imagen["name"]);
                $uploadOk=1;
            } 

            try{
                if($this->mNiff->createNiff()){
                    if($uploadOk==1){
                        $mensaje = "Se registro con exito!";
                    }else{
                        $mensaje = "Se registro con exito, pero la imagen y el pdf no se pudieron almacenar en el servidor";
                    }
                }else{
                    $mensaje = "Ocurrio un error registrando";
                }
            }catch(Exception $e){
                $mensaje = "Ocurrio un error ".$e->getMessage();
            }


        }else{
            $mensaje = "No fue posible actualizar los estados.";
        }
        
        echo json_encode(['msj'=>$mensaje]);
    }

    public function updateEstadoNiff($id, $estado){

        $mensaje = "";

        if($this->mNiff->updateAllNiff()){

            $this->mNiff->__SET('_id_niff', $id);
            $this->mNiff->__SET('_estado', $estado);

            try{
                if($this->mNiff->updateEstadoNiff()){
                    $mensaje = "Se modifico con exito!";
                }else{
                    $mensaje = "Ocurrio un error modificando";
                }
            }catch(Exception $e){
                $mensaje = "Ocurrio un error ".$e->getMessage();
            }

        }else{
            $mensaje = "No fue posible actualizar los estados.";
        }
    
        return json_encode(['msj'=>$mensaje]);
    }

    
    public function deleteNiff($id){
        $this->mNiff->__SET('_id_niff', $id);
        $resultado = $this->mNiff->deleteNiff();
        return json_encode($resultado);
    }
}