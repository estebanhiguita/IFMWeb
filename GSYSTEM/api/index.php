<?php 

require 'Config/Config.php';
require 'Controller/controller.php';
require 'Library/Slim/Slim.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

///////////////////////////////////////////////////////////

$app->post('/listarExpertos', function () {
    $ctr = Controller::loadController("Expertos");
    echo $ctr->getAllExpertos();
});

$app->post('/deleteExpertos', function () {
    $ctr = Controller::loadController("Expertos");
    echo $ctr->deleteExpertos($_POST["id"]);
});

$app->post('/createExpertos', function () {
    $ctr = Controller::loadController("Expertos");
    echo $ctr->createExpertos($_POST["txtNombre"],$_POST["txtSkype"],$_POST["txtEmail"],$_FILES["file"]);
});

$app->post('/updateExpertos', function () {
    $ctr = Controller::loadController("Expertos");
    echo $ctr->updateExpertos($_POST["txtIdExpertos"], $_POST["txtNombre"],$_POST["txtSkype"],$_POST["txtEmail"],$_FILES["file"]);
});

$app->post('/updateEstadoExpertos', function () {
    $ctr = Controller::loadController("Expertos");
    echo $ctr->updateEstadoExpertos($_POST["id"], $_POST["estado"]);
});

$app->post('/selectUnidadNegocioActivas', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->getAllUnidadNegocioActivas();
});

//////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////

$app->post('/deleteProductos', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->deleteProducto($_POST["id"]);
});


$app->post('/deleteGaleria', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->deleteGaleria($_POST["id"]);
});

$app->post('/listarProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllProducto();
});

$app->post('/listarProductoServidor', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllProductoServidor($_POST["id"]);
});

$app->post('/listarProductoxMarca', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllProductoxMarca($_POST["id"]);
});

$app->post('/listarProductoAllxMarca', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllProductoAllxMarca($_POST["id"]);
});

$app->post('/listarProductosOferta', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllProductosOferta();
});

$app->post('/listarGaleriaProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllGaleriaProducto($_POST["id"]);
});

$app->post('/listarGaleriaProductoActivo', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->getAllGaleriaProductoActivo($_POST["id"]);
});


$app->post('/createProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->createProducto($_POST["ddlTipoProducto"], $_POST["txtNombre"],$_POST["txtDescripcion"],$_POST["ddlOferta"],$_POST["txtPrecio"],$_POST["ddlDestacado"],$_POST["txtPorcentaje"],$_FILES["file"],$_POST["ddlMarca"]);
});

$app->post('/subirGaleria', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->subirGaleria($_FILES["file"], $_POST["idProductoGaleria"]);
});

$app->post('/updateProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->updateProducto($_POST["ddlTipoProducto"], $_POST["txtIdProducto"], $_POST["txtNombre"],$_POST["txtDescripcion"],$_POST["ddlOferta"],$_POST["txtPrecio"],$_POST["ddlDestacado"],$_POST["txtPorcentaje"],$_FILES["file"],$_POST["ddlMarca"]);
});

$app->post('/updateEstadoProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->updateEstadoProducto($_POST["id"], $_POST["estado"]);
});

$app->post('/updateEstadoGaleriaProducto', function () {
    $ctr = Controller::loadController("Producto");
    echo $ctr->updateEstadoGaleriaProducto($_POST["id"], $_POST["estado"]);
});

///////////////////////////////////////////////////////////

////////////////////////////////////////////////////

$app->post('/deleteSlide', function () {
    $ctr = Controller::loadController("Slides");
    echo $ctr->deleteSlides($_POST["id"]);
});

$app->post('/createSlides', function () {
    $ctr = Controller::loadController("Slides");
    echo $ctr->createSlide($_FILES["file"], $_POST["ddlUnidad"], $_POST["txtUrl"]);
});


$app->post('/listarSlides', function () {
    $ctr = Controller::loadController("Slides");
    echo $ctr->getAllSlide();
});

$app->post('/SlidesUnidad', function () {
    $ctr = Controller::loadController("Slides");
    echo $ctr->getSlidesUnidad($_POST["idUnidad"]);
});

$app->post('/updateEstadoSlides', function () {
    $ctr = Controller::loadController("Slides");
    echo $ctr->updateEstadoSlide($_POST["id"], $_POST["estado"]);
});

//////////////////////////////////////////

////////////////////////////////////////////////////////

$app->post('/updateEstadoNoticia', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->updateEstadoNoticia($_POST["id"], $_POST["estado"]);
});

$app->post('/deleteNoticia', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->deleteNoticia($_POST["id"]);
});

$app->post('/listarNoticia', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->getAllNoticia();
});

$app->post('/listarNoticiaxFecha', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->getAllNoticiaxFecha();
});

$app->post('/createNoticia', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->createNoticia($_POST["txtTitulo"], $_POST["txtDescripcion"], $_FILES["file"], $_POST["txtFechaInicio"], $_POST["txtFechaFin"],$_POST["txtUrl"]);
});

$app->post('/updateNoticia', function () {
    $ctr = Controller::loadController("Noticia");
    echo $ctr->updateNoticia($_POST["txtIdNoticia"], $_POST["txtTitulo"], $_POST["txtDescripcion"], $_FILES["file"], $_POST["txtFechaInicio"], $_POST["txtFechaFin"],$_POST["txtUrl"]);
});

////////////////////////////////////////////////////////

// API Marcas Start

$app->post('/deleteMarca', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->deleteMarca($_POST["id"]);
});


$app->get('/listarMarcas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->getAllMarcas();
});

$app->post('/MarcasActivas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->MarcasActivas();
});

$app->post('/createMarcas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->createMarcas($_POST["nombreMarca"],$_FILES["urlMarca"]);
});

$app->post('/updateMarcas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->updateMarcas($_POST["idMarca"], $_POST["nombreMarca"], $_FILES["urlMarca"]);
});

$app->post('/updateEstadoMarcas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->updateEstadoMarcas($_POST["idMarca"], $_POST["estado"]);
});

$app->get('/listarMarcasActivas', function () {
    $ctr = Controller::loadController("Marcas");
    echo $ctr->getAllMarcasActive();
});

// API Marcas End

// API Partners Start

$app->post('/deletePartner', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->deletePartners($_POST["id"]);
});

$app->get('/listarPartners', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->getAllPartners();
});

$app->post('/createPartners', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->createPartners($_POST["nombrePartner"],$_FILES["urlPartner"]);
});

$app->post('/updatePartners', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->updatePartners($_POST["idPartner"], $_POST["nombrePartner"], $_FILES["urlPartner"]);
});

$app->post('/updateEstadoPartners', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->updateEstadoPartners($_POST["idPartner"], $_POST["estado"]);
});

$app->get('/listarPartnersActivas', function () {
    $ctr = Controller::loadController("Partners");
    echo $ctr->getAllPartnersActive();
});

// API Partners End

// API Casos Start

$app->post('/deleteCaso', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->deleteCaso($_POST["id"]);
});

$app->get('/listarCasos', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->getAllCasos();
});

$app->post('/createCasos', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->createCasos($_POST["nombreCaso"],$_FILES["urlCaso"]);
});

$app->post('/updateCasos', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->updateCasos($_POST["idCaso"], $_POST["nombreCaso"], $_FILES["urlCaso"]);
});

$app->post('/updateEstadoCasos', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->updateEstadoCasos($_POST["idCaso"], $_POST["estado"]);
});

$app->get('/listarCasosActivas', function () {
    $ctr = Controller::loadController("Casos");
    echo $ctr->getAllCasosActive();
});

// API Casos End


// API Unidades Start

$app->post('/deleteUnidades', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->deleteUnidades($_POST["id"]);
});

$app->get('/listarUnidades', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->getAllUnidadNegocio();
});

$app->post('/videoUnidad', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->getVideoUnidadNegocio($_POST["idUnidad"]);
});

$app->post('/createUnidades', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->createUnidades($_POST["nombreUnidad"],$_FILES["urlUnidad"],$_POST["urlVideo"]);
});

$app->post('/updateUnidades', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->updateUnidades($_POST["idUnidad"], $_POST["nombreUnidad"], $_FILES["urlUnidad2"],$_FILES["urlUnidad"],$_POST["urlVideo"]);
});

$app->get('/listarUnidadesActivas', function () {
    $ctr = Controller::loadController("UnidadNegocio");
    echo $ctr->getAllUnidadNegocioActivas();
});
// API Unidades End


//////////////////////////////////////////////////////////////////

$app->post('/deleteListaPrecio', function () {
    $ctr = Controller::loadController("ListaPrecio");
    echo $ctr->deleteListaPrecio($_POST["id"]);
});

$app->post('/listarListaPrecio', function () {
    $ctr = Controller::loadController("ListaPrecio");
    echo $ctr->getAllListaPrecio();
});

$app->post('/listarListaPrecioxEstado', function () {
    $ctr = Controller::loadController("ListaPrecio");
    echo $ctr->getAllListaPrecioxEstado();
});

$app->post('/createListaPrecio', function () {
    $ctr = Controller::loadController("ListaPrecio");
    echo $ctr->createListaPrecio($_FILES["imagen"], $_FILES["pdf"]);
});

$app->post('/updateEstadoListaPrecio', function () {
    $ctr = Controller::loadController("ListaPrecio");
    echo $ctr->updateNoticia($_POST["id"], $_POST["estado"]);
});

//////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////

$app->post('/deleteNiff', function () {
    $ctr = Controller::loadController("Niff");
    echo $ctr->deleteNiff($_POST["id"]);
});

$app->post('/listarNiff', function () {
    $ctr = Controller::loadController("Niff");
    echo $ctr->getAllNiff();
});

$app->post('/listarNiffxEstado', function () {
    $ctr = Controller::loadController("Niff");
    echo $ctr->getAllNiffxEstado();
});

$app->post('/createNiff', function () {
    $ctr = Controller::loadController("Niff");
    echo $ctr->createNiff($_FILES["imagen"]);
});

$app->post('/updateEstadoNiff', function () {
    $ctr = Controller::loadController("Niff");
    echo $ctr->updateEstadoNiff($_POST["id"], $_POST["estado"]);
});

//////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////

$app->get('/listarSuscripcion', function () {
    $ctr = Controller::loadController("Suscripcion");
    echo $ctr->getAllSuscripcion();
});

$app->post('/createSuscripcion', function () {
    $ctr = Controller::loadController("Suscripcion");
    echo $ctr->createSuscripcion($_POST["txtEmail"]);
});

///////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////

$app->get('/listarContacto', function () {
    $ctr = Controller::loadController("Contacto");
    echo $ctr->getAllContacto();
});

$app->post('/createContacto', function () {
    $ctr = Controller::loadController("Contacto");
    echo $ctr->createContacto($_POST["txtNombre"],$_POST["txtEmail"],$_POST["txtTelefono"],$_POST["txtDescripcion"]);
});

$app->post('/updateContacto', function () {
    $ctr = Controller::loadController("Contacto");
    echo $ctr->updateContacto($_POST["id"], $_POST["estado"]);
});

///////////////////////////////////////////////////////////////



$app->run();
