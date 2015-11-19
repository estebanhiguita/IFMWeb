<?php

class Noticia extends Controller
{
    private $mNoticia = null;

    public function __construct(){
        $this->mNoticia = $this->loadModel("clsNoticia");
    }

    public function getAllNoticia(){
        $resultado = $this->mNoticia->getAllNoticia();
               $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllNoticiaxFecha(){
        $resultado = $this->mNoticia->getAllNoticiaxFecha();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    } 

    public function createNoticia($titulo, $descripcion, $file, $fecha_inicio, $fecha_fin, $url){

    	$mensaje = "";

    	$this->mNoticia->__SET('_titulo', $titulo);
    	$this->mNoticia->__SET('_descripcion', $descripcion);
        
        $this->mNoticia->__SET('_fecha_inicio', $fecha_inicio);
        $this->mNoticia->__SET('_fecha_fin', $fecha_fin);
        $this->mNoticia->__SET('_url', $url);

    	$target_dir = "../Admin/dist/upload/Noticias/";
		$target_file = $target_dir . $file["name"];

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if ($uploadOk != 0) 
		{
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		    	$this->mNoticia->__SET('_url_imagen', $file["name"]);
		    } 
		}

    	try{
    		if($this->mNoticia->createNoticia()){
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

   	public function updateNoticia($id, $titulo, $descripcion, $file, $fecha_inicio, $fecha_fin, $url){

    	$mensaje = "";

        $this->mNoticia->__SET('_id_noticia', $id);
    	$this->mNoticia->__SET('_titulo', $titulo);
    	$this->mNoticia->__SET('_descripcion', $descripcion);
        
        $this->mNoticia->__SET('_fecha_inicio', $fecha_inicio);
        $this->mNoticia->__SET('_fecha_fin', $fecha_fin);
        $this->mNoticia->__SET('_url', $url);

    	$bImage = 0;
    	$uploadOk = 1;


    	if($file["name"] != ''){

	    	$target_dir = "../Admin/dist/upload/Noticias/";
			$target_file = $target_dir . $file["name"];

			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($uploadOk != 0) 
			{
			    if (move_uploaded_file($file["tmp_name"], $target_file)) {

			    	$this->mNoticia->__SET('_url_imagen', $file["name"]);
			    	$bImage = 1;
			    } 
			}

    	}

    	try{
    		if($this->mNoticia->updateNoticia($bImage)){
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


    public function updateEstadoNoticia($id, $estado){

        $mensaje = "";

        $this->mNoticia->__SET('_id_noticia', $id);
        $this->mNoticia->__SET('_estado', $estado);

        try{
            if($this->mNoticia->updateEstadoNoticia()){
                
                $mensaje = "Se modifico el estado con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando el estado del caso de éxito";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }


    public function deleteNoticia($id){
        $this->mNoticia->__SET('_id_noticia', $id);
        $resultado = $this->mNoticia->deleteNoticia();
        return json_encode($resultado);
    }

}