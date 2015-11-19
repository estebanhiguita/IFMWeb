<?php
//Cmentar
class Expertos extends Controller
{
    private $mExpertos = null;

    public function __construct(){
        $this->mExpertos = $this->loadModel("clsExpertos");
    }

    public function getAllExpertos(){
        $resultado = $this->mExpertos->getAllExpertos();
        $json = json_encode($resultado);

        //$json = str_replace('"\u0001"', '"1"', $json);
        //$json = str_replace('"\u0000"', '"0"', $json);
    //    var_dump($json);
        return $json;
    }  

 

    public function createExpertos($nombre, $url, $profesion, $cargo, $file, $estado){

    	$mensaje = "";

    	$this->mExpertos->__SET('_nombre', $nombre);
        $this->mExpertos->__SET('_url', $url);
    	$this->mExpertos->__SET('_profesion', $profesion);
    	$this->mExpertos->__SET('_cargo', $cargo);


    	$target_dir = "../Admin/dist/upload/Expertos/";
		$target_file = $target_dir . $file["name"];

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if ($uploadOk != 0) 
		{
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		    	$this->mExpertos->__SET('_url', $file["name"]);
		    } 
		}

    	try{
    		if($this->mExpertos->createExpertos()){
    			if($uploadOk==1){
    				$mensaje = "Se registró con exito!";
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

   	public function updateExpertos($id, $nombre, $url, $profesion, $cargo, $file){

    	$mensaje = "";

    	$this->mExpertos->__SET('_id_expertos', $id);
    	$this->mExpertos->__SET('_nombre', $nombre);
        $this->mExpertos->__SET('_url', $url);
    	$this->mExpertos->__SET('_profesion', $profesion);
    	$this->mExpertos->__SET('_cargo', $cargo);

    	$bImage = 0;
    	$uploadOk = 1;


    	if($file["name"] != ''){

	    	$target_dir = "../Admin/dist/upload/Expertos/";
			$target_file = $target_dir . $file["name"];

			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($uploadOk != 0) {

			    if (move_uploaded_file($file["tmp_name"], $target_file)) {
			    	$this->mExpertos->__SET('_url', $file["name"]);
			    	$bImage = 1;
			    } else {
			
			    }
			}

    	}

    	return json_encode(['msj'=>$mensaje]);
    }

    public function deleteExpertos($id){
        $this->mExpertos->__SET('_id_expertos', $id);
        $resultado = $this->mExpertos->deleteExpertos();
        return json_encode($resultado);
    }

    



}