SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS bibliotecauni;

USE bibliotecauni;

DROP TABLE IF EXISTS administrador_biblioteca;

CREATE TABLE `administrador_biblioteca` (
  `id_bibliotecario` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(40) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `id_extreme` varchar(50) NOT NULL,
  PRIMARY KEY (`id_bibliotecario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO administrador_biblioteca VALUES("7","admin","d033e22ae348aeb5660fc2140aec35850c4da997","");



DROP TABLE IF EXISTS categorias;

CREATE TABLE `categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `id_subcategoria` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `id_subcategoria` (`id_subcategoria`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO categorias VALUES("1","Programacion Avanzada II","3");
INSERT INTO categorias VALUES("2","Aplicaciones web","2");
INSERT INTO categorias VALUES("4","Estadisticas","2");
INSERT INTO categorias VALUES("8","Python 3","2");
INSERT INTO categorias VALUES("9","PHP avanzado","4");
INSERT INTO categorias VALUES("10","HTML 5","3");
INSERT INTO categorias VALUES("11","Base de datos","2");
INSERT INTO categorias VALUES("12","Ingenieria de Sistemas","3");
INSERT INTO categorias VALUES("13","Informatica","2");



DROP TABLE IF EXISTS comentarios;

CREATE TABLE `comentarios` (
  `id_comentario` int(10) NOT NULL AUTO_INCREMENT,
  `remitente` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO comentarios VALUES("5","marcos","Malquitox10@gmail.com","Solicitar Libro","Me gustaria pedir el libro de Candy Crush","2023-08-02");



DROP TABLE IF EXISTS libros;

CREATE TABLE `libros` (
  `id_libro` int(10) NOT NULL AUTO_INCREMENT,
  `foto` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET latin1 NOT NULL,
  `descripcion` varchar(255) CHARACTER SET latin1 NOT NULL,
  `disponible` varchar(2) CHARACTER SET latin1 NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `id_subcategoria` int(10) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `url_descarga` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_libro`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO libros VALUES("3","images/mysql.jpg","Mysql Version Avanzada","Para crear aplicaciones dinamicas","si","2","2","2","2016-01-07","http://mediafire.com/id=203044");
INSERT INTO libros VALUES("39","images/product1.jpg","Java 8 para pros","lirbo de java pro","si","1","5","1","2023-08-04",".");
INSERT INTO libros VALUES("40","images/product2.jpg","HTML y CSS","html y css ","si","1","7","1","2023-08-04",".");
INSERT INTO libros VALUES("41","images/product3.jpg","PHP y MySQL","php y mysql","si","9","4","1","2023-08-04",".");
INSERT INTO libros VALUES("42","images/product4.jpg","jQuery","jquery","si","2","8","1","2023-08-04",".");



DROP TABLE IF EXISTS pdf;

CREATE TABLE `pdf` (
  `id_pdf` int(10) NOT NULL AUTO_INCREMENT,
  `id_libro` int(10) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `tamanio` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pdf`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `pdf_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO pdf VALUES("1","5","javascript","Buen Libro","13311","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("2","3","Mysql Avanzado","Para conectar base de datos","970475","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("3","4","HTML 5","Para aplicaciones web","635134","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("4","5","Java Enterprise Edition","Para aplicaciones moviles y de escritorio","294261","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("5","9","Jquery","Sincronizacion con el servidor","405398","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("6","10","php","Buen Libro","13311","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("7","11","pyton","Para conectar base de datos","970475","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("8","12","Visual Basic","Para aplicaciones web","635134","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("9","6","Asp. Net","Para aplicaciones moviles y de escritorio","294261","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("10","17","C#","Sincronizacion con el servidor","405398","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("11","3","mysql","dkdkff","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("12","3","mysql","dkdkff","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("13","3","mysql","dkdkff","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("14","3","mysql","dkdkff","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("15","4","HTML 5","bueno","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("16","17","C# Avanzado","bueno","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("17","30","informatica2","bueno","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("18","31","dkfk","dkkf","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("19","28","prueba","bueno","171766","application/pdf","libro.pdf");
INSERT INTO pdf VALUES("20","8","Libro pdf de ajax","es bueno","403835","application/pdf","art08.pdf");
INSERT INTO pdf VALUES("21","9","Libro de Ejemplo para Angel","Es de buena calidad","915929","application/pdf","slidex.tips_catalogo-de-celulares.pdf");
INSERT INTO pdf VALUES("22","6","Prueba de libro con nivel avanzado","Es una prueba de nivel avanzado 12 de Noviembre","98304","application/pdf","tabla_caracteres-ASCII.pdf");



DROP TABLE IF EXISTS prestamo_libro;

CREATE TABLE `prestamo_libro` (
  `id_prestamo` int(100) NOT NULL AUTO_INCREMENT,
  `fecha_prestamo` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `id_libro` int(10) NOT NULL,
  `id_usuario_estudiante` int(10) NOT NULL,
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `id_libro` (`id_libro`),
  KEY `id_usuario_estudiante` (`id_usuario_estudiante`),
  CONSTRAINT `prestamo_libro_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`),
  CONSTRAINT `prestamo_libro_ibfk_2` FOREIGN KEY (`id_usuario_estudiante`) REFERENCES `usuario_estudiante` (`id_usuario_estudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

INSERT INTO prestamo_libro VALUES("21","2023-08-01","2023-08-04","3","9","1");
INSERT INTO prestamo_libro VALUES("22","2023-08-04","2023-08-07","3","9","1");



DROP TABLE IF EXISTS proveedor;

CREATE TABLE `proveedor` (
  `id_proveedor` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO proveedor VALUES("1","Libreria COPASA","Managgua","234955","gomper23@gmail.com");
INSERT INTO proveedor VALUES("2","Libreria COPASA","Managgua","234955","gomper23@gmail.com");



DROP TABLE IF EXISTS subcategorias;

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_subcategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO subcategorias VALUES("1","C");
INSERT INTO subcategorias VALUES("2","C#");
INSERT INTO subcategorias VALUES("3","C++");
INSERT INTO subcategorias VALUES("4","php");
INSERT INTO subcategorias VALUES("5","java");
INSERT INTO subcategorias VALUES("6","python");
INSERT INTO subcategorias VALUES("7","html");
INSERT INTO subcategorias VALUES("8","Javascript 3");



DROP TABLE IF EXISTS suscriptores;

CREATE TABLE `suscriptores` (
  `id_suscriptor` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(30) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fecha_suscripcion` date DEFAULT NULL,
  PRIMARY KEY (`id_suscriptor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO suscriptores VALUES("17","","malqutiox10@gmail.com","","2023-07-31");



DROP TABLE IF EXISTS usuario_estudiante;

CREATE TABLE `usuario_estudiante` (
  `id_usuario_estudiante` int(10) NOT NULL AUTO_INCREMENT,
  `carnet` varchar(15) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `anio` varchar(10) NOT NULL,
  `carrera` varchar(30) NOT NULL,
  PRIMARY KEY (`id_usuario_estudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO usuario_estudiante VALUES("9","27658076","marquitos","guzman","fuegonacional@gmail.com","5to.","Ingenieria de Sistemas");



DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(180) DEFAULT NULL,
  `password` varchar(180) DEFAULT NULL,
  `email` varchar(180) DEFAULT NULL,
  `id_extreme` varchar(180) DEFAULT NULL,
  `rol` varchar(15) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `imagen` blob DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS visitantes;

CREATE TABLE `visitantes` (
  `idvisitante` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `estadoPais` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `alias` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `edad` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `sexo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `pais` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idvisitante`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO visitantes VALUES("8","Marcos Marquitos Marquicio Marquin","Marquitosuwu","marquitos12345","Malquitox10@gmail.com","0426748844","Acarigua","Araure","Portuguesa","Marquitosuwu","22","Masculino","Venezuela","1","2023-07-31 10:33:22");



DROP TABLE IF EXISTS visitas;

CREATE TABLE `visitas` (
  `utc` int(10) NOT NULL,
  `fecha_visita` date NOT NULL,
  `ip` varchar(50) NOT NULL,
  `navegador` varchar(255) NOT NULL,
  `pagina` varchar(255) NOT NULL,
  PRIMARY KEY (`utc`),
  UNIQUE KEY `utc` (`utc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO visitas VALUES("1690814473","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690814479","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690814527","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php?cat=13");
INSERT INTO visitas VALUES("1690814618","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690814686","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690814844","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690820995","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_programacion.php");
INSERT INTO visitas VALUES("1690821006","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690821021","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690821025","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690821030","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690821036","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690821295","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690821302","2023-07-31","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690841273","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690841275","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690841694","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690841734","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690841891","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690842669","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690847661","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690847691","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_programacion.php");
INSERT INTO visitas VALUES("1690847695","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690847696","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690847698","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690847767","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690847814","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php?cat=12");
INSERT INTO visitas VALUES("1690858025","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690858033","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690858057","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690858068","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690858473","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690858517","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_programacion.php");
INSERT INTO visitas VALUES("1690858523","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690858583","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php?cat=12");
INSERT INTO visitas VALUES("1690858898","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690858907","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php?cat=2");
INSERT INTO visitas VALUES("1690858923","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690858926","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690858981","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859022","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859042","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859080","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859147","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859277","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859281","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859481","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859485","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859490","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859500","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php?buscar=sql&enviar=Buscar+Libro");
INSERT INTO visitas VALUES("1690859502","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859510","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php?buscar=sql&enviar=Buscar+Libro");
INSERT INTO visitas VALUES("1690859513","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859558","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859569","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859579","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859580","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859583","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690859594","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690859930","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859962","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690859966","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690860032","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860061","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860064","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690860071","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860131","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860273","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860286","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860303","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860316","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860328","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860415","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860526","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690860989","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861003","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861015","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861028","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861042","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861051","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861119","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861132","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861219","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861265","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861267","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690861268","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690861272","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690861529","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690861692","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690862401","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690900872","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690900890","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901043","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901073","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901078","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901213","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901394","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690901700","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690901707","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690901816","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690901851","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902025","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902055","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902082","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902124","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902223","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902229","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902238","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902239","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902255","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902256","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902415","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902417","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/hemeroteca.php");
INSERT INTO visitas VALUES("1690902449","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/hemeroteca.php");
INSERT INTO visitas VALUES("1690902502","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/hemeroteca.php");
INSERT INTO visitas VALUES("1690902504","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902510","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902615","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690902618","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/biblionline.php");
INSERT INTO visitas VALUES("1690902628","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902633","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690902634","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902636","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/hemeroteca.php");
INSERT INTO visitas VALUES("1690902637","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690902922","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690903394","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690903487","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690903496","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690903498","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/biblionline.php");
INSERT INTO visitas VALUES("1690903500","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/hemeroteca.php");
INSERT INTO visitas VALUES("1690903523","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690903606","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690903610","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_programacion.php");
INSERT INTO visitas VALUES("1690903611","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_informatica.php");
INSERT INTO visitas VALUES("1690903614","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690903615","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_bd.php");
INSERT INTO visitas VALUES("1690903617","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_web.php");
INSERT INTO visitas VALUES("1690904010","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690914933","2023-08-01","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930359","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930378","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930387","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930390","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690930394","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690930457","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690930553","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690930555","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930567","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930586","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690930614","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/contacto.php");
INSERT INTO visitas VALUES("1690930666","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690930966","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690930967","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931008","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690931012","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690931013","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931019","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931022","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931055","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931058","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931060","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931063","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931068","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931072","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931075","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931077","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931087","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/prestamos.php");
INSERT INTO visitas VALUES("1690931088","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931091","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931094","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931099","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931119","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931618","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931856","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931891","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931904","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690931966","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690932172","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690932177","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690932186","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690932420","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/biblionline.php");
INSERT INTO visitas VALUES("1690932423","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php");
INSERT INTO visitas VALUES("1690932430","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php?=pagina=4");
INSERT INTO visitas VALUES("1690932462","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php?=pagina=4");
INSERT INTO visitas VALUES("1690932493","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php?=pagina=4");
INSERT INTO visitas VALUES("1690932506","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php?=pagina=4");
INSERT INTO visitas VALUES("1690932526","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda2.php?=pagina=4");
INSERT INTO visitas VALUES("1690932586","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690932594","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/biblionline.php");
INSERT INTO visitas VALUES("1690932595","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690934470","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1690934474","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/biblionline.php");
INSERT INTO visitas VALUES("1690934479","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690934486","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1690934497","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_programacion.php");
INSERT INTO visitas VALUES("1690934503","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_sistemas.php");
INSERT INTO visitas VALUES("1690934506","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_informatica.php");
INSERT INTO visitas VALUES("1690934508","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_bd.php");
INSERT INTO visitas VALUES("1690934509","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_web.php");
INSERT INTO visitas VALUES("1690940542","2023-08-02","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/libros_web.php");
INSERT INTO visitas VALUES("1691164452","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1691164466","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691164469","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1691164471","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691164472","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1691164475","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691164477","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1691164483","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165098","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");
INSERT INTO visitas VALUES("1691165105","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165199","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165229","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165240","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165268","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165271","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165306","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165307","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691165316","2023-08-04","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691188373","2023-08-05","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/busqueda.php");
INSERT INTO visitas VALUES("1691335863","2023-08-06","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 OPR/100.0.0.0","/biblioteca/inicio.php");



SET FOREIGN_KEY_CHECKS=1;