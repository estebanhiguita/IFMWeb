<?php

class Producto extends Controller
{
    private $mProducto = null;

    public function __construct(){
        $this->mProducto = $this->loadModel("clsProducto");
    }

    public function getAllProductosOferta(){
        $resultado = $this->mProducto->getAllProductosOferta();
        
        $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllProducto(){
        $resultado = $this->mProducto->getAllProducto();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   


    public function getAllProductoServidor($id){
        $this->mProducto->__SET("_tipo_producto", $id);
        $resultado = $this->mProducto->getAllProductoServidor();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   


    public function getAllProductoxMarca($id){
        $this->mProducto->__SET("_id_marca", $id);
        $resultado = $this->mProducto->getAllProductoxMarca();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   

    public function getAllProductoAllxMarca($id){
        $this->mProducto->__SET("_id_marca", $id);
        $resultado = $this->mProducto->getAllProductoAllxMarca();
                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    }   


    public function getAllGaleriaProducto($id){
        $this->mProducto->__SET("_id_producto", $id);
        $resultado = $this->mProducto->getAllGaleriaProducto();

                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    } 

    public function getAllGaleriaProductoActivo($id){
        $this->mProducto->__SET("_id_producto", $id);
        $resultado = $this->mProducto->getAllGaleriaProductoActivo();

                $json = json_encode($resultado);

        $json = str_replace('"\u0001"', '"1"', $json);
        $json = str_replace('"\u0000"', '"0"', $json);

        return $json;
    } 

    

    public function createProducto($tipo_producto, $nombre, $descripcion, $oferta, $precio, $destacado, $porcentaje_oferta, $file, $idMarca){

    	$mensaje = "";

    	$this->mProducto->__SET('_nombre', $nombre);
    	$this->mProducto->__SET('_descripcion', $descripcion);
        $this->mProducto->__SET('_oferta', $oferta);
        $this->mProducto->__SET('_precio', $precio);
        $this->mProducto->__SET('_porcentaje_oferta', $porcentaje_oferta);
        $this->mProducto->__SET('_destacado', $destacado);
        $this->mProducto->__SET('_id_marca', $idMarca);
    	$this->mProducto->__SET('_tipo_producto', $tipo_producto);


    	$target_dir = "../Admin/dist/upload/Productos/";
		$target_file = $target_dir . $file["name"];

		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
		if ($uploadOk != 0) 
		{
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		    	$this->mProducto->__SET('_url', $file["name"]);
		    } 
		}

    	try{
    		if($this->mProducto->createProducto()){
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

    	echo json_encode(['msj'=>$mensaje, 'id'=>$this->mProducto->ultimoId()]);
    }

   	public function updateProducto($tipo_producto, $id, $nombre, $descripcion, $oferta, $precio, $destacado, $porcentaje_oferta, $file, $idMarca){

    	$mensaje = "";

        $this->mProducto->__SET('_id_producto', $id);
        $this->mProducto->__SET('_nombre', $nombre);
        $this->mProducto->__SET('_descripcion', $descripcion);
        $this->mProducto->__SET('_oferta', $oferta);
        $this->mProducto->__SET('_porcentaje_oferta', $porcentaje_oferta);
        $this->mProducto->__SET('_precio', $precio);
        $this->mProducto->__SET('_destacado', $destacado);
        $this->mProducto->__SET('_id_marca', $idMarca);
        $this->mProducto->__SET('_tipo_producto', $tipo_producto);

    	$bImage = 0;
    	$uploadOk = 1;


    	if($file["name"] != ''){

	    	$target_dir = "../Admin/dist/upload/Productos/";
			$target_file = $target_dir . $file["name"];

			
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if ($uploadOk != 0) {

			    if (move_uploaded_file($file["tmp_name"], $target_file)) {
			    	$this->mProducto->__SET('_url', $file["name"]);
			    	$bImage = 1;
			    } else {
			
			    }
			}

    	}

    	try{
    		if($this->mProducto->updateProducto(1, $bImage)){
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


    public function updateEstadoProducto($id, $estado){

    	$mensaje = "";

    	$this->mProducto->__SET('_id_producto', $id);
    	$this->mProducto->__SET('_estado', $estado);

    	try{
    		if($this->mProducto->updateProducto(0, 0)){
    			
    			$mensaje = "Se modifico con exito!";
    			
    		}else{
    			$mensaje = "Ocurrio un error modificando";
    		}
    	}catch(Exception $e){
    		$mensaje = "Ocurrio un error ".$e->getMessage();
    	}

    	return json_encode(['msj'=>$mensaje]);
    }


    public function updateEstadoGaleriaProducto($id, $estado){

        $mensaje = "";

        $this->mProducto->__SET('_id_galeria', $id);
        $this->mProducto->__SET('_estado', $estado);

        try{
            if($this->mProducto->updateGaleriaProducto()){
                
                $mensaje = "Se modifico con exito!";
                
            }else{
                $mensaje = "Ocurrio un error modificando";
            }
        }catch(Exception $e){
            $mensaje = "Ocurrio un error ".$e->getMessage();
        }

        return json_encode(['msj'=>$mensaje]);
    }


    



    public function subirGaleria($file, $id){

        if($id != null){

                $mensaje = "";

                $target_dir = "../Admin/dist/upload/Productos/".$id."/";

                if (!file_exists($target_dir)) {
                    mkdir($target_dir);
                } 


                for ($i = 0; $i < count($file["name"]); $i++) {

                    $target_file = $target_dir . $file["name"][$i];
                    //var_dump($target_file);
                    $uploadOk = 1;

                    if($uploadOk!=0){
                        if (move_uploaded_file($file["tmp_name"][$i], $target_file)) {

                            $this->mProducto->__SET("_url", "/".$id."/".$file["name"][$i]);
                            $this->mProducto->__SET("_id_producto",$id);

                            if($this->mProducto->GuardarGaleria()){
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

    public function deleteGaleria($id){
        $this->mProducto->__SET('_id_galeria', $id);
        $resultado = $this->mProducto->deleteGaleria();
        return json_encode($resultado);
    }

    public function deleteProducto($id){
        $mensaje = "";
        $this->mProducto->__SET('_id_producto', $id);
        try{
            $mensaje = $this->mProducto->deleteProducto();
        }catch(Exception $e){
            $mensaje = "Se debe eliminar la galeria de este producto.";
        }
        return json_encode($mensaje);
    }

}