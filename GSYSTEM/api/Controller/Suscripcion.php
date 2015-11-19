<?php

class Suscripcion extends Controller
{

    private $mSuscripcion = null;

    public function __construct(){
        $this->mSuscripcion = $this->loadModel("clsSuscripcion");
    }

    public function getAllSuscripcion(){
        $resultado = $this->mSuscripcion->getAllSuscripcion();
        
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   


    public function createSuscripcion($email){

        $mensaje = "";
        $this->mSuscripcion->__SET("_email", $email);
        try{
            if($this->mSuscripcion->createSuscripcion()){
                
                $mensaje = "Se registro con exito!";
                
            }else{
                $mensaje = "Ocurrio un error registrando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        echo json_encode(['msj'=>$mensaje]);
    }

}