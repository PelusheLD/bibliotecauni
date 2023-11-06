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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO administrador_biblioteca VALUES("","","","");
INSERT INTO administrador_biblioteca VALUES("","","","");
INSERT INTO administrador_biblioteca VALUES("","","","");
INSERT INTO administrador_biblioteca VALUES("","","","");



DROP TABLE IF EXISTS categorias;

CREATE TABLE `categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `id_subcategoria` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `id_subcategoria` (`id_subcategoria`),
  CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategorias` (`id_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");
INSERT INTO categorias VALUES("","","");



DROP TABLE IF EXISTS comentarios;

CREATE TABLE `comentarios` (
  `id_comentario` int(10) NOT NULL AUTO_INCREMENT,
  `remitente` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_comentario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO comentarios VALUES("","","","","","");



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
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_libro`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_proveedor` (`id_proveedor`),
  CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");
INSERT INTO libros VALUES("","","","","","","","","","","");



DROP TABLE IF EXISTS pdf;

CREATE TABLE `pdf` (
  `id_pdf` int(10) NOT NULL AUTO_INCREMENT,
  `id_libro` int(10) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` mediumtext,
  `tamanio` int(10) unsigned DEFAULT NULL,
  `tipo` varchar(150) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pdf`),
  KEY `id_libro` (`id_libro`),
  CONSTRAINT `pdf_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");
INSERT INTO pdf VALUES("","","","","","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO prestamo_libro VALUES("","","","","","");
INSERT INTO prestamo_libro VALUES("","","","","","");



DROP TABLE IF EXISTS proveedor;

CREATE TABLE `proveedor` (
  `id_proveedor` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_proveedor` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` int(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO proveedor VALUES("","","","","");
INSERT INTO proveedor VALUES("","","","","");



DROP TABLE IF EXISTS subcategorias;

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_subcategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");
INSERT INTO subcategorias VALUES("","");



DROP TABLE IF EXISTS suscriptores;

CREATE TABLE `suscriptores` (
  `id_suscriptor` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(30) DEFAULT NULL,
  `correo` varchar(30) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `fecha_suscripcion` date DEFAULT NULL,
  PRIMARY KEY (`id_suscriptor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO suscriptores VALUES("","","","","");
INSERT INTO suscriptores VALUES("","","","","");
INSERT INTO suscriptores VALUES("","","","","");
INSERT INTO suscriptores VALUES("","","","","");
INSERT INTO suscriptores VALUES("","","","","");



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO usuario_estudiante VALUES("","","","","","","");
INSERT INTO usuario_estudiante VALUES("","","","","","","");
INSERT INTO usuario_estudiante VALUES("","","","","","","");



DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
  `ID` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(180) DEFAULT NULL,
  `password` varchar(180) DEFAULT NULL,
  `email` varchar(180) DEFAULT NULL,
  `id_extreme` varchar(180) DEFAULT NULL,
  `rol` varchar(15) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `imagen` blob,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO usuarios VALUES("","","","","","","","");



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

INSERT INTO visitas VALUES("","","","","");
INSERT INTO visitas VALUES("","","","","");
INSERT INTO visitas VALUES("","","","","");



SET FOREIGN_KEY_CHECKS=1;