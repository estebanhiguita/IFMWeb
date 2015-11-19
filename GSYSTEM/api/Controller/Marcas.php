<?php

class Marcas extends Controller
{
    private $mMarcas = null;

    public function __construct(){
        $this->mMarcas = $this->loadModel("clsMarcas");
    }

    public function getAllMarcas(){
        $resultado = $this->mMarcas->getAllMarcas();

        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllMarcasActive(){
        $resultado = $this->mMarcas->getAllMarcasActive();
        
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }  

    public function MarcasActivas(){
        $resultado = $this->mMarcas->MarcasActivas();
        
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }  

    public function createMarcas($nombre, $url){
        $mensaje = "";

        $this->mMarcas->__SET('_nombre', $nombre);
        $this->mMarcas->__SET('_estado', true);


        $target_dir = "../Admin/dist/upload/Marcas/";
        $target_file = $target_dir . $url["name"];

        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if (move_uploaded_file($url["tmp_name"], $target_file)) {
            $this->mMarcas->__SET('_url', $url["name"]);
        }
        try{
            if($this->mMarcas->createMarcas()){
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

    public function updateMarcas($id, $nombre, $url){

        $mensaje = "";

        $this->mMarcas->__SET('_id_marca', $id);
        $this->mMarcas->__SET('_nombre', $nombre);

        $bImage = 0;
        $uploadOk = 1;


        if($url["name"] != ''){

            $target_dir = "../Admin/dist/upload/Marcas/";
            $target_file = $target_dir . $url["name"];

            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


            if (move_uploaded_file($url["tmp_name"], $target_file)) {
                $this->mMarcas->__SET('_url', $url["name"]);
                $bImage = 1;
            }
        }

        try{
            if($this->mMarcas->updateMarcas($bImage)){
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

    public function updateEstadoMarcas($id, $estado){

        $mensaje = "";

        $this->mMarcas->__SET('_id_marca', $id);
        $this->mMarcas->__SET('_estado', $estado);

        try{
            if($this->mMarcas->updateEstadoMarcas()){
                
                $mensaje = "Se modifico el estado con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando el estado de la marca";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }

    public function deleteMarca($id){
        $mensaje = "";
        $this->mMarcas->__SET('_id_marca', $id);
        try{
            $mensaje = $this->mMarcas->deleteMarca();
        }catch(Exception $e){
            $mensaje = "Se debe eliminar los productos relacionados con esta marca.";
        }
        return json_encode($mensaje);
    }
    
}

?>