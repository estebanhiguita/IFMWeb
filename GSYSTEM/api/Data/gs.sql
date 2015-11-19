-- ---------------------------------------------------------
  --
  -- SIMPLE SQL Dump
  -- 
  -- http://www.nawa.me/
  --
  -- Host Connection Info: localhost via TCP/IP
  -- Generation Time: June 29, 2015 at 23:37 PM ( Europe/Berlin )
  -- Server version: 5.6.16
  -- PHP Version: 5.5.11
  --
  -- ---------------------------------------------------------



  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8 */;
  

          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_caso_exito`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_caso_exito` (
  `id_caso_exito` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `url_imagen` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`id_caso_exito`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_caso_exito`
          --

          INSERT INTO `tbl_caso_exito` (`id_caso_exito`, `nombre`, `url_imagen`, `estado`) VALUES
(1, 'Acuatubos ', 'acuatubos.PNG', 1),
(3, 'Bccontructores ', 'bc constructores.PNG', 1),
(5, 'ValdesPalacio ', 'ValdesPalacio.png', 1),
(6, 'Laura', 'laura.png', 1),
(7, 'Caribe', 'productos el caribe.png', 1),
(8, 'Casdiquim ', 'casdiquim.png', 1),
(9, 'CentralQuimica', 'Central quimica.png', 1),
(10, 'Dimotriz', 'dimotriz.png', 1),
(11, 'DistribucionesHernandez', 'distribuciones hernandez.png', 1),
(12, 'dqi', 'dqi.png', 1),
(13, 'Elementos ', 'elementos y complemeto ltda.png', 1),
(14, 'EuroCeramica', 'euro ceramica.png', 1),
(15, 'FabioRamirez', 'fabio ramirez.png', 1),
(16, 'HelpPharma', 'helpharma.PNG', 1),
(17, 'Humax', 'humax.png', 1),
(18, 'Hybritech', 'Hybrytec.png', 1),
(19, 'Herval', 'induestrias Herval.png', 1),
(20, 'IndustriasPlasticasMM', 'industrias plasticas mm.png', 1),
(21, 'Molpet', 'moldpet.png', 1),
(22, 'Panamericana', 'panamericana.png', 1),
(23, 'MundoYamaha', 'mundo yamaha.png', 1),
(24, 'Moldplast', 'moldplast.png', 1),
(25, 'Polikem', 'polikem.png', 1),
(26, 'Simelca', 'simelca.png', 1);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_cliente`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `estado` bit(1) NOT NULL,
  `tipo_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_contacto`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_contacto` (
  `id_contacto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  `email` varchar(65) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_contacto`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_contacto`
          --

          INSERT INTO `tbl_contacto` (`id_contacto`, `nombre`, `email`, `telefono`, `descripcion`, `estado`, `fecha`) VALUES
(1, 'Yhoan Andres Galeano', 'yhoangaleano@gmail.com', 3218517452, 'Probando los comentarios', 1, '2015-06-16 15:02:20');



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_expertos`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_expertos` (
  `id_expertos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `skype` varchar(60) NOT NULL,
  `email` varchar(55) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `url` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  `tbl_unidad_negocio_id_unidad_negocio` int(11) NOT NULL,
  PRIMARY KEY (`id_expertos`),
  KEY `fk_tbl_expertos_tbl_unidad_negocio_idx` (`tbl_unidad_negocio_id_unidad_negocio`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_expertos`
          --

          INSERT INTO `tbl_expertos` (`id_expertos`, `nombre`, `skype`, `email`, `telefono`, `url`, `estado`, `tbl_unidad_negocio_id_unidad_negocio`) VALUES
(4, 'Alexander Vargas', 'alexuajps1', 'avargas@gestionsystem.com.co', '321 832 21 86', 'Alexander Vargas Morales.JPG', 1, 4),
(3, 'Alba Lucia Jiménez ', 'alba_lucia_jimenez', 'ajimenez@gestionsystem.com.co', '321 371 74 43', 'Alba Lucia Jiménez Soto.jpg', 1, 4),
(5, 'Ana María González', 'ana.maria.0225', 'agonzalez@gestionsystem.com.co', '313 746 00 63', 'Ana Maria González.JPG', 1, 4),
(6, 'Carlos Alberto Bernal ', 'cbernalj', 'cbernal@gestionsystem.com.co', '320 676 94 97', 'Carlos Bernal.JPG', 1, 4),
(7, 'Carolina González ', 'caritogonza21', 'cgonzalez@gestionsystem.com.co', '304 387 3963', 'Carolina González.jpg', 1, 4),
(8, 'Christian Camilo López', 'dartzgalager', 'clopez@gestionsystem.com.co', '314 809 60 22', 'Cristian López.JPG', 1, 4),
(9, 'Jhon Alexander Uribe', 'jhon.uribe', 'juribe@gestionsystem.com.co', ' 313 658 49 36', 'Jhon Uribe.jpg', 1, 4),
(10, 'Luisa Fernanda Álvarez', 'lufealg', 'lalvarez@gestionsystem.com.co', '311 325 54 84', 'Luisa Fernanda Alvarez.jpg', 1, 4),
(11, 'Luz Dary Espinosa', 'lespinosa50', 'lespinosa@gestionsystem.com.co', '313 746 00 53', 'Luz Dary Espinosa.jpg', 1, 4),
(12, 'Olga Tangarife', 'olga.tangarife', 'otangarife@gestionsystem.com.co', '312 776 17 40', 'OlgaTangarife.JPG', 1, 4),
(13, 'Paola Arboleda', 'parboleda_3', 'parboleda@gestionsystem.com.co', '314 652 02 70', 'Paola Arboleda Espinosa.JPG', 1, 4),
(14, 'Patricia Pérez Londoño', 'patriciaisabelpl', 'pperez@gestionsystem.com.co', '311 605 51 80', 'Patricia Perez Londoño.jpg', 1, 4),
(15, 'Julian Andres Uribe ', 'julian.uribe.gs', 'julian.uribe@gestionsystem.com.co', '313 604 04 02', 'Julian Uribe.JPG', 1, 4),
(16, 'David González', 'davidgonzalez.dim', 'dgonzalez@gestionsystem.com.co', '321 852 58 67', 'David González Londoño.JPG', 1, 9),
(17, 'Angela Espinosa', 'luzanespinosa2', 'aespinosa@gestionsystem.com.co', '320 766 76 72', 'Angela Espinosa.JPG', 1, 9),
(18, 'Carlos Andrés Martínez ', 'dircomercial.gs', 'cmartinez@gestionsystem.com.co', '310 371 97 54', 'Carlos Andrés Martinez.jpg', 1, 3),
(19, 'Evangelina Gómez ', 'comercialgs1', 'egomez@gestionsystem.com.co', '321 644 79 50 ', 'Evangelina Gómez Urrea.jpg', 1, 3),
(20, 'Juliana Jaimes Diaz', 'comercial.gs4', 'jjaimes@gestionsystem.com.co', '301 493 64 56', 'Juliana Jaimes Diaz.JPG', 1, 3);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_galeria`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `url_imagen` varchar(100) DEFAULT NULL,
  `estado` bit(1) DEFAULT NULL,
  `tbl_producto_id_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_galeria`),
  KEY `fk_tbl_galeria_tbl_producto1_idx` (`tbl_producto_id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_galeria`
          --

          INSERT INTO `tbl_galeria` (`id_galeria`, `url_imagen`, `estado`, `tbl_producto_id_producto`) VALUES
(14, '/1/631x421 3.jpg', 1, 1),
(12, '/1/631x421 2.jpg', 1, 1),
(13, '/1/631x421 1.jpg', 1, 1),
(15, '/3/631x421 1.JPG', 1, 3),
(16, '/3/631x421 2.jpg', 1, 3),
(17, '/3/631x421 3.jpg', 1, 3),
(21, '/4/631x421 4.jpg', 1, 4),
(20, '/4/631x421 5.jpg', 1, 4),
(22, '/5/631x421 6.jpg', 1, 5),
(23, '/6/Microsoft 1.JPG', 1, 6),
(24, '/7/Microsoft 2.JPG', 1, 7),
(26, '/8/Microsoft 3.jpg', 1, 8),
(27, '/9/Microsoft 1.JPG', 1, 9),
(28, '/10/GrandStream.JPG', 1, 10),
(34, '/11/Microserver.JPG', 1, 11),
(33, '/11/Microserver 3.JPG', 1, 11),
(32, '/11/Microserver 2.JPG', 1, 11),
(35, '/12/hp dl380 2.JPG', 1, 12),
(36, '/12/hp dl380.JPG', 1, 12);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_lista_precio`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_lista_precio` (
  `id_lista_precio` int(11) NOT NULL AUTO_INCREMENT,
  `url_imagen` varchar(100) NOT NULL,
  `url_pdf` varchar(100) NOT NULL,
  `estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_lista_precio`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_lista_precio`
          --

          INSERT INTO `tbl_lista_precio` (`id_lista_precio`, `url_imagen`, `url_pdf`, `estado`) VALUES
(5, '/img/2listadoPrecios500x219.JPG', '/pdf/Ventas.pdf', 1);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_marca`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_marca` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `url` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_marca`
          --

          INSERT INTO `tbl_marca` (`id_marca`, `nombre`, `url`, `estado`) VALUES
(1, 'HP', 'HP.png', 1),
(2, 'Lenovo', 'lenovo.png', 1),
(6, 'Microsoft ', 'Microsoft.PNG', 1),
(8, 'Toshiba', 'Toshiba.PNG', 1);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_niff`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_niff` (
  `id_niff` int(11) NOT NULL AUTO_INCREMENT,
  `url_imagen` varchar(100) NOT NULL,
  `estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_niff`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_niff`
          --

          INSERT INTO `tbl_niff` (`id_niff`, `url_imagen`, `estado`) VALUES
(1, 'Niff1.JPG', 1);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_noticia`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_noticia` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `url_imagen` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` bit(1) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_noticia`
          --

          INSERT INTO `tbl_noticia` (`id_noticia`, `titulo`, `descripcion`, `url_imagen`, `fecha_inicio`, `fecha_fin`, `estado`, `url`) VALUES
(1, 'El Equipo Ideal ', 'Encuentra con nosotros el equipo ideal. ', 'BarraDeNoticias2.jpg', '2015-06-14', '2015-06-30', 1, 'http://www.gestionsystem.com.co/ComercialVentas.html'),
(3, 'GS DIGITAL MARKETING', 'MUY PRONTO GS DIGITAL MARKETING', 'BarraDeNoticias1.JPG', '2015-06-12', '2015-06-25', 1, 'https://www.facebook.com/gestionsystem?ref=hl');



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_partner`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_partner` (
  `id_partner` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `url_imagen` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`id_partner`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_partner`
          --

          INSERT INTO `tbl_partner` (`id_partner`, `nombre`, `url_imagen`, `estado`) VALUES
(31, 'Eset', 'eset.PNG', 1),
(2, 'Ofimatica ', 'Ofimática.png', 1),
(3, 'Microsoft', 'Microsoft.PNG', 1),
(4, 'Adobe ', 'Adobe.png', 1),
(5, 'Apple ', 'apple.png', 0),
(6, 'Asus', 'asus.png', 1),
(7, 'Autodesk', 'autodesk.png', 0),
(8, 'Cisco', 'cisco.png', 1),
(9, 'Dell', 'dell.png', 1),
(10, 'Epson', 'epson.png', 1),
(11, 'Nicomar ', 'nicomar.png', 1),
(12, 'Hp', 'HP.png', 1),
(13, 'Intel ', 'Intel.png', 1),
(14, 'Kingston ', 'kingston.png', 1),
(15, 'Lenovo ', 'lenovo.png', 1),
(16, 'Vaio', 'Vaio.PNG', 1),
(17, 'Motorola ', 'motorola.png', 1),
(18, 'Acer', 'acer.png', 1),
(19, 'Samsung ', 'SAMSUNG.png', 1),
(20, 'Sony', 'SONY.png', 0),
(21, 'Toshiba ', 'Toshiba.PNG', 1),
(22, 'Tplink', 'tp link.png', 1),
(23, 'Unifi ', 'unifi.png', 1),
(24, 'Xerox', 'xerox.png', 0),
(26, 'AMD', 'Amd.PNG', 1),
(27, 'Kyocera ', 'Kyocera.PNG', 1),
(30, 'McCafee', 'mcafee.png', 1),
(29, 'Nvidia ', 'Nvidia.PNG', 1);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_persona`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_persona`
          --

          INSERT INTO `tbl_persona` (`id_persona`, `nombre`, `usuario`, `clave`) VALUES
(1, 'gsystem', 'usuario_gs', 'g35t1on2015!');



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_producto`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `oferta` bit(1) NOT NULL,
  `precio` varchar(20) NOT NULL,
  `destacado` bit(1) NOT NULL,
  `porcentaje_oferta` float DEFAULT '0',
  `url` varchar(100) NOT NULL,
  `estado` bit(1) NOT NULL,
  `tbl_marca_id_marca` int(11) NOT NULL,
  `tipo_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_tbl_producto_tbl_marca_idx` (`tbl_marca_id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_producto`
          --

          INSERT INTO `tbl_producto` (`id_producto`, `nombre`, `descripcion`, `oferta`, `precio`, `destacado`, `porcentaje_oferta`, `url`, `estado`, `tbl_marca_id_marca`, `tipo_producto`) VALUES
(1, 'Servidor HP ProLiant  ML310e / 736327-001', 'GEN8 V2 SATA - LFF INTEL® XEON® QUAD-CORE E3-1240V3 - 3.4GHZ, 8MB L3 CACHE, 8GB RAM, 1 PROCESADOR,FORMATO TORRE, CONVERTIBLE A 4U PARA RACK MEDIANTE OPCIONAL QUE LO HABILITA (KIT PARA RACK, VER OPCION', 0, 0, 1, 0, 'HP Server.jpg', 1, 1, 3),
(3, '10B7001RLS LENOVO THINKCENTRE  M73E TINY', 'Intel I3, Windows 8.1 Profesional,  4 GB RAM,  500 GB DD,  HDMI,  GARANTÍA 3 AÑOS,  Pantalla 18,5 pulgadas HD.', 0, 0, 1, 0, '631x421 1.jpg', 1, 2, 1),
(4, '10BD004HLS - EQUIPO ALL IN ONE  LENOVO THINKCENTRE', 'Intel I5,Intel I3, Windows 8.1 Profesional, 4 GB RAM, 500 GB DD, HDMI, GARANTÍA 3 AÑOS, Pantalla 20 pulgadas HD, Cámara integrada. ', 0, 0, 1, 0, '631x421 4.jpg', 1, 2, 1),
(5, ' 10AU004ALS SFF  LENOVO THINKCENTRE E73', 'Procesador Intel I3,  Windows 8 Profesional, 4 GB RAM, 500 GB DD, HDMI, GARANTÍA 3 AÑOS, Pantalla 18,5 pulgadas HD.', 0, 0, 1, 0, '631x421 6.jpg', 1, 2, 1),
(8, 'LICENCIA MS OEM  WID PRO 8.1 X 64', 'LICENCIA MS OEM  WID PRO 8.1 X 64  SP1PK DSP OEI DVD  FQC-06998', 0, 0, 1, 0, 'Microsoft 3.jpg', 1, 6, 1),
(6, 'Microsoft Office Home & Business', 'Microsoft Office Home & Business 2013 incluye:
\nWord, Excel, Power Point, Outlook, OneNote', 0, 0, 1, 0, 'Microsoft 1.JPG', 1, 6, 1),
(7, 'LICENCIA WINDOWS  PRO 8.1 32/64 BIT', 'LICENCIA WINDOWS  PRO 8.1 32/64 BIT  SPANISH DVD  CAJA FQC-07355', 0, 0, 1, 0, 'Microsoft 2.JPG', 1, 6, 1),
(10, 'Grandstream GXP 1405', 'Teléfono IP 2 líneas/HD/POE', 0, 0, 1, 0, 'GrandStream.JPG', 0, 9, 1),
(11, 'HP PROLIANT MICROSERVER GEN8 ', 'Intel® Pentium® G2020T 2.5 GHz, 3M Cache, 6GB 1600MHz DDR3, Expandable up to 16GB. ', 0, 0, 1, 0, 'Microserver.JPG', 1, 1, 2),
(12, 'Servidor HP ProLiant DL380 Gen9', 'Familia de procesador
\nFamilia de productos Intel® Xeon® E5-2600 v3
\nNúmero de procesadores
\n1 o 2
\nNúcleo de procesador disponible
\n18 o 16 u 14 o 12 o 10 u 8 o 6 o 4
\nForm factor (totalmente configu', 0, 0, 1, 0, 'hp dl380.JPG', 1, 1, 4);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_slide`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_slide` (
  `id_slide` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_imagen` varchar(45) NOT NULL,
  `url_imagen` varchar(100) NOT NULL,
  `url` varchar(205) NOT NULL,
  `estado` bit(1) NOT NULL,
  `tbl_unidad_negocio_id_unidad_negocio` int(11) NOT NULL,
  PRIMARY KEY (`id_slide`),
  KEY `fk_tbl_slide_tbl_unidad_negocio1_idx` (`tbl_unidad_negocio_id_unidad_negocio`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_slide`
          --

          INSERT INTO `tbl_slide` (`id_slide`, `nombre_imagen`, `url_imagen`, `url`, `estado`, `tbl_unidad_negocio_id_unidad_negocio`) VALUES
(1, 'Slider1.jpg', '/1/Slider1.jpg', 'http://gestionsystem.com.co/index.html', 1, 1),
(2, 'Slider2.jpg', '/1/Slider2.jpg', 'http://gestionsystem.com.co/index.html', 1, 1),
(3, 'Slider3.jpg', '/1/Slider3.jpg', 'http://gestionsystem.com.co/index.html', 1, 1),
(4, 'Slider4.jpg', '/1/Slider4.jpg', 'http://gestionsystem.com.co/index.html', 1, 1),
(35, 'slider5.JPG', '/1/slider5.JPG', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 1),
(6, 'SliderCasosExito1.jpg', '/2/SliderCasosExito1.jpg', 'http://gestionsystem.com.co/index.html', 1, 2),
(7, 'SliderCasosExito2.jpg', '/2/SliderCasosExito2.jpg', 'http://gestionsystem.com.co/index.html', 1, 2),
(8, 'Imagenfondo4.jpg', '/8/Imagenfondo4.jpg', 'http://gestionsystem.com.co/nosotros.html', 1, 8),
(9, 'Imagenfondo2.jpg', '/8/Imagenfondo2.jpg', 'http://gestionsystem.com.co/nosotros.html', 1, 8),
(10, 'Imagenfondo3.jpg', '/8/Imagenfondo3.jpg', 'http://gestionsystem.com.co/nosotros.html', 1, 8),
(11, 'Consultoria1.jpg', '/4/Consultoria1.jpg', 'http://gestionsystem.com.co/index.html', 1, 4),
(12, 'Consultoria2.jpg', '/4/Consultoria2.jpg', 'http://gestionsystem.com.co/index.html', 1, 4),
(13, 'ImagenFondo4.jpg', '/6/ImagenFondo4.jpg', 'http://gestionsystem.com.co/index.html', 1, 6),
(14, 'ImagenFondo5.jpg', '/6/ImagenFondo5.jpg', 'http://gestionsystem.com.co/index.html', 1, 6),
(15, 'ComercialOfimatica1.JPG', '/3/ComercialOfimatica1.JPG', 'http://gestionsystem.com.co/index.html', 1, 3),
(16, 'Consultoria1.jpg', '/3/Consultoria1.jpg', 'http://gestionsystem.com.co/comercialOfimatica.html', 1, 3),
(17, 'Formacion2.jpg', '/5/Formacion2.jpg', 'http://gestionsystem.com.co/formacion.html', 1, 5),
(30, 'SliderSoporte.jpg', '/7/SliderSoporte.jpg', 'http://gestionsystem.com.co/soporte.html', 1, 7),
(19, 'slider.JPG', '/9/slider.JPG', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9),
(38, 'Ultrabook.jpg', '/9/Ultrabook.jpg', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9),
(22, 'slider3.jpg', '/9/slider3.jpg', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9),
(25, 'slider4.JPG', '/9/slider4.JPG', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9),
(27, 'ComercialOfimatica2.JPG', '/3/ComercialOfimatica2.JPG', 'http://gestionsystem.com.co/comercialOfimatica.html', 1, 3),
(29, '2.JPG', '/5/2.JPG', 'http://gestionsystem.com.co/formacion.html', 1, 5),
(31, 'SliderSoporte2.jpg', '/7/SliderSoporte2.jpg', 'http://gestionsystem.com.co/soporte.html', 1, 7),
(32, 'SliderSoporte3.jpg', '/7/SliderSoporte3.jpg', 'http://gestionsystem.com.co/soporte.html', 1, 7),
(33, 'SliderSoporte4.jpg', '/7/SliderSoporte4.jpg', 'http://gestionsystem.com.co/soporte.html', 1, 7),
(34, 'RackALaMedida.jpg', '/9/RackALaMedida.jpg', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9),
(37, 'Software.JPG', '/9/Software.JPG', 'http://gestionsystem.com.co/ComercialVentas.html', 1, 9);



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_suscripcion`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_suscripcion` (
  `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_suscripcion`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_suscripcion`
          --

          INSERT INTO `tbl_suscripcion` (`id_suscripcion`, `email`, `fecha`) VALUES
(1, 'j-deiby@hotmail.com', '2015-06-16 14:59:04');



          -- ---------------------------------------------------------
          --
          -- Table structure for table : `tbl_unidad_negocio`
          --
          -- ---------------------------------------------------------

          CREATE TABLE `tbl_unidad_negocio` (
  `id_unidad_negocio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `url_logo` varchar(100) NOT NULL,
  `url_video` varchar(200) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id_unidad_negocio`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

          --
          -- Dumping data for table `tbl_unidad_negocio`
          --

          INSERT INTO `tbl_unidad_negocio` (`id_unidad_negocio`, `nombre`, `url_logo`, `url_video`, `estado`) VALUES
(1, 'Home', 'Logo_GS_200.png', 'https://www.youtube.com/embed/CE85i7w5KtI', 1),
(2, 'Casos de éxito', 'Logo_GS_200.png', 'https://www.youtube.com/embed/gsI2zWGDNBU', 1),
(3, 'Comercial Ofimática  ', 'OFIMATICA.png', 'https://www.youtube.com/embed/CE85i7w5KtI', 1),
(4, 'Consultoría ', 'CONSULTORIA.png', 'https://www.youtube.com/embed/CE85i7w5KtI', 1),
(5, 'Formación ', 'FORMACION.png', 'https://www.youtube.com/embed/CE85i7w5KtI', 1),
(6, 'GPS Desarrollo', 'GPS.png', 'https://www.youtube.com/embed/tsEe1o0SZ0c', 1),
(7, 'Soporte', 'INFORMATICA.png', 'https://www.youtube.com/embed/CE85i7w5KtI', 1),
(8, 'Nosotros', 'Logo_GS_200.png', 'https://www.youtube.com/embed/1f_TwCx33CM', 1),
(9, 'Comercial Ventas', 'VENTAS.png', 'https://www.youtube.com/embed/oTISG_Yhmn8', 1);



  -- FORANEAS

  ALTER TABLE `tbl_expertos`
  ADD CONSTRAINT `fk_tbl_expertos_tbl_unidad_negocio` FOREIGN KEY (`tbl_unidad_negocio_id_unidad_negocio`) REFERENCES `tbl_unidad_negocio` (`id_unidad_negocio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  --
  -- Filtros para la tabla `tbl_galeria`
  --
  ALTER TABLE `tbl_galeria`
  ADD CONSTRAINT `fk_tbl_galeria_tbl_producto1` FOREIGN KEY (`tbl_producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  --
  -- Filtros para la tabla `tbl_producto`
  --
  ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `fk_tbl_producto_tbl_marca` FOREIGN KEY (`tbl_marca_id_marca`) REFERENCES `tbl_marca` (`id_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

  --
  -- Filtros para la tabla `tbl_slide`
  --
  ALTER TABLE `tbl_slide`
  ADD CONSTRAINT `fk_tbl_slide_tbl_unidad_negocio1` FOREIGN KEY (`tbl_unidad_negocio_id_unidad_negocio`) REFERENCES `tbl_unidad_negocio` (`id_unidad_negocio`) ON DELETE NO ACTION ON UPDATE NO ACTION;


  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;