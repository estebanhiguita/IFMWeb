<?php

class Slides extends Controller
{
    private $mSlides = null;

    public function __construct(){
        $this->mSlides = $this->loadModel("clsSlides");
    }

    public function getAllSlide(){
        $resultado = $this->mSlides->getAllSlides();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }

    public function getSlidesUnidad($idUnidad){
        $this->mSlides->__SET("_id_unidad_negocio", $idUnidad);
        $resultado = $this->mSlides->getSlidesUnidad();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }  

    public function createSlide($file, $id, $url){

        if($id != null){

            $mensaje = "";

            $target_dir = "../Admin/dist/upload/Slides/".$id."/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir);
            } 

            for ($i = 0; $i < count($file["name"]); $i++) {

                $target_file = $target_dir . $file["name"][$i];
                //var_dump($target_file);
                $uploadOk = 1;

                if($uploadOk!=0){
                    if (move_uploaded_file($file["tmp_name"][$i], $target_file)) {

                        $this->mSlides->__SET("_nombre_imagen", $file["name"][$i]);
                        $this->mSlides->__SET("_url_imagen", "/".$id."/".$file["name"][$i]);
                        $this->mSlides->__SET("_url", $url[$i]);
                        $this->mSlides->__SET("_id_unidad_negocio", $id);

                        if($this->mSlides->createSlides()){
                            $mensaje = "La imagen se registro a la galeria";
                        }else{
                            $mensaje = "El nombre de la imagen ya existe";
                        }

                    } else {
                        $mensaje = "El nombre de la imagen ya existe";
                    }
                }
                
            }

            return json_encode(['msj'=>$mensaje]);
        }
    }

    public function updateEstadoSlide($id, $estado){

    	$mensaje = "";

    	$this->mSlides->__SET('_id_slide', $id);
    	$this->mSlides->__SET('_estado', $estado);

    	try{
    		if($this->mSlides->updateSlides()){
    			
    			$mensaje = "Se modifico con exito!";
    			
    		}else{
    			$mensaje = "Ocurrio un error modificando";
    		}
    	}catch(Exception $e){
    		$mensaje = "Ocurrio un error ".$e->getMessage();
    	}

    	return json_encode(['msj'=>$mensaje]);
    }

    public function deleteSlides($id){
        $this->mSlides->__SET('_id_slide', $id);
        $resultado = $this->mSlides->deleteSlides();
        return json_encode($resultado);
    }

}