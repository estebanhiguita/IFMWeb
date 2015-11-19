<?php

class ListaPrecio extends Controller
{
    private $mListaPrecio = null;

    public function __construct(){
        $this->mListaPrecio = $this->loadModel("clsListaPrecio");
    }

    public function getAllListaPrecio(){
        $resultado = $this->mListaPrecio->getAllListaPrecio();
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllListaPrecioxEstado(){
        $resultado = $this->mListaPrecio->getAllListaPrecioxEstado();
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    } 

    public function createListaPrecio($imagen, $pdf){

        $mensaje = "";

        
        if($this->mListaPrecio->updateAllListaPrecio()){

            $uploadOk=0;

            $target_dir_i = "../Admin/dist/upload/ListaPrecio/img/";
            $target_dir_p = "../Admin/dist/upload/ListaPrecio/pdf/";

            $target_file_image = $target_dir_i . $imagen["name"];
            $target_file_pdf = $target_dir_p . $pdf["name"];

            if (move_uploaded_file($imagen["tmp_name"], $target_file_image) && move_uploaded_file($pdf["tmp_name"], $target_file_pdf)) {
                $this->mListaPrecio->__SET('_url_imagen', "/img/".$imagen["name"]);
                $this->mListaPrecio->__SET('_url_pdf', "/pdf/".$pdf["name"]);
                $uploadOk=1;
            } 

            try{
                if($this->mListaPrecio->createListaPrecio()){
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

    public function updateNoticia($id, $estado){

        $mensaje = "";

        if($this->mListaPrecio->updateAllListaPrecio()){

            $this->mListaPrecio->__SET('_id_lista_precio', $id);
            $this->mListaPrecio->__SET('_estado', $estado);

            try{
                if($this->mListaPrecio->updateEstadoListaPrecio()){
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

    public function deleteListaPrecio($id){
        $this->mListaPrecio->__SET('_id_lista_precio', $id);
        $resultado = $this->mListaPrecio->deleteListaPrecio();
        return json_encode($resultado);
    }
}