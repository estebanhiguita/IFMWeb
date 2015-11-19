<?php

class Partners extends Controller
{
    private $mPartners = null;

    public function __construct(){
        $this->mPartners = $this->loadModel("clsPartners");
    }

    public function getAllPartners(){
        $resultado = $this->mPartners->getAllPartners();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllPartnersActive(){
        $resultado = $this->mPartners->getAllPartnersActive();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }  

    public function createPartners($nombre, $url){
        $mensaje = "";

        $this->mPartners->__SET('_nombre', $nombre);
        $this->mPartners->__SET('_estado', true);


        $target_dir = "../Admin/dist/upload/Partners/";
        $target_file = $target_dir . $url["name"];

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if (move_uploaded_file($url["tmp_name"], $target_file)) {
            $this->mPartners->__SET('_url', $url["name"]);
        }
        try{
            if($this->mPartners->createPartners()){
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

    public function updatePartners($id, $nombre, $url){

        $mensaje = "";

        $this->mPartners->__SET('_id_partner', $id);
        $this->mPartners->__SET('_nombre', $nombre);

        $bImage = 0;
        $uploadOk = 1;


        if($url["name"] != ''){

            $target_dir = "../Admin/dist/upload/Partners/";
            $target_file = $target_dir . $url["name"];

            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


            if (move_uploaded_file($url["tmp_name"], $target_file)) {
                $this->mPartners->__SET('_url', $url["name"]);
                $bImage = 1;
            }
        }

        try{
            if($this->mPartners->updatePartners($bImage)){
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

    public function updateEstadoPartners($id, $estado){

        $mensaje = "";

        $this->mPartners->__SET('_id_partner', $id);
        $this->mPartners->__SET('_estado', $estado);

        try{
            if($this->mPartners->updateEstadoPartners()){
                
                $mensaje = "Se modifico el estado con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando el estado del partner";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }
    

    public function deletePartners($id){
        $this->mPartners->__SET('_id_partner', $id);
        $resultado = $this->mPartners->deletePartners();
        return json_encode($resultado);
    }
}

?>