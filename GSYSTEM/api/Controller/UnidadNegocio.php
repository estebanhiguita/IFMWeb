<?php

class UnidadNegocio extends Controller
{
    private $mUnidadNegocio = null;

    public function __construct(){
        $this->mUnidadNegocio = $this->loadModel("clsUnidadNegocio");
    }

    public function getAllUnidadNegocio(){
        $resultado = $this->mUnidadNegocio->getAllUnidadNegocio();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }

    public function getVideoUnidadNegocio($id){
        $this->mUnidadNegocio->__SET('_id_unidad_negocio', $id);
        $resultado = $this->mUnidadNegocio->getVideoUnidadNegocio();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }

    public function getAllUnidadNegocioActivas(){
        $resultado = $this->mUnidadNegocio->getAllUnidadNegocioActivas();
        return json_encode($resultado);
    }

    public function updateUnidades($id, $nombre, $url, $url2, $descripcion){

        $mensaje = "";

        $this->mUnidadNegocio->__SET('_id_unidad_negocio', $id);
        $this->mUnidadNegocio->__SET('_nombre', $nombre);
        $this->mUnidadNegocio->__SET('_url_video', $urlVideo);

        $bImage = 0;
        $uploadOk = 1;


        if($url["name"] != ''){

            $target_dir = "../Admin/dist/upload/Unidades/";
            $target_file = $target_dir . $url["name"];

            
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


            if (move_uploaded_file($url["tmp_name"], $target_file)) {
                $this->mUnidadNegocio->__SET('_url_logo', $url["name"]);
                $bImage = 1;
            }
        }

        try{
            if($this->mUnidadNegocio->updateUnidades($bImage)){
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

    public function deleteUnidades($id){
        $mensaje = "";
        $this->mUnidadNegocio->__SET('_id_unidad_negocio', $id);
        try{
            $mensaje = $this->mUnidadNegocio->deleteUnidades();
        }catch(Exception $e){
            $mensaje = "Se debe eliminar el slide y los expertos relacionados ha esta unidad de negocio.";
        }
        return json_encode($mensaje);
    }

}