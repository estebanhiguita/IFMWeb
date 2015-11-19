<?php

class Contacto extends Controller
{

    private $mContacto = null;

    public function __construct(){
        $this->mContacto = $this->loadModel("clsContacto");
    }

    public function getAllContacto(){
        $resultado = $this->mContacto->getAllContacto();
        
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   


    public function createContacto($nombre, $email, $telefono, $descripcion){

        $mensaje = "";
        $this->mContacto->__SET("_nombre", $nombre);
        $this->mContacto->__SET("_email", $email);
        $this->mContacto->__SET("_telefono", $telefono);
        $this->mContacto->__SET("_descripcion", $descripcion);

        try{
            if($this->mContacto->createContacto()){
                
                $mensaje = "Se registro con exito!";
                
            }else{
                $mensaje = "Ocurrio un error registrando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        echo json_encode(['msj'=>$mensaje]);
    }

    public function updateContacto($id, $estado){

        $mensaje = "";

        $this->mContacto->__SET('_id_contacto', $id);
        $this->mContacto->__SET('_estado', $estado);

        try{
            if($this->mContacto->updateContacto()){
                
                $mensaje = "Se modifico con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }

}