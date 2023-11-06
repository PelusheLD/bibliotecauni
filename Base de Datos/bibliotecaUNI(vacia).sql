create database bibliotecaUNI;
 
  use bibliotecaUNI;

  create table if not exists usuario_estudiante (
  id_usuario_estudiante int (10) primary key not null auto_increment,
  carnet varchar (15) not null,
  nombre varchar(40) not null,
  apellidos varchar(40)not  null,
  email varchar(30) not null,
  usuario varchar(20) not null,
  contrasena varchar(128) not null
) ENGINE=InnoDB;

create table if not exists comentarios (
  id_comentario int(10) primary key NOT null auto_increment,
  remitente varchar(50) NOT null,
  correo varchar(50) NOT null,
  mensaje varchar(250) NOT null,
  fecha date NOT null
) ENGINE=InnoDB;

create table if not exists subcategorias (
  id_subcategoria int(10) primary key NOT null auto_increment,
  nombre_subcategoria varchar(50) NOT null
) ENGINE=InnoDB;

create table if not exists categorias (
  id_categoria int(10) primary key NOT null auto_increment,
  nombre_categoria varchar(50) NOT null
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS proveedor (
  id_proveedor int(10) primary key not null auto_increment,
  nombre_completo varchar(50) not null,
  direccion varchar(100) not null,
  telefono int(10) not null,
  email varchar(30) not null
) ENGINE=InnoDB;

create table if not exists libros (
  id_libro int(10) primary key not null auto_increment,
  foto varchar (50) null,
  nombre varchar(255) not null,
  descripcion varchar(255) not null,
  disponible varchar (2) not null,
  id_categoria int(10) not null,
  id_subcategoria int(10) not null,
  id_proveedor int(10) not null,
  fecha_ingreso date null,
  url_descarga varchar (250) null,
  foreign key (id_categoria) references subcategorias(id_subcategoria),
  foreign key (id_subcategoria) references categorias(id_categoria),
  foreign key (id_proveedor) references proveedor(id_proveedor)
) ENGINE=InnoDB;

create table if not exists pdf (
id_pdf int(10) primary key auto_increment NOT null,
id_libro int (10) not null,
titulo varchar(150) DEFAULT null,
descripcion mediumtext,
tamanio int(10) unsigned DEFAULT null,
tipo varchar(150) DEFAULT null,
nombre_archivo varchar(255) DEFAULT null,
foreign key (id_libro) references libros(id_libro)
) ENGINE=InnoDB;

create table if not exists suscriptores (
  id_suscriptor int(10) primary key  not null auto_increment,
  nombre_completo varchar(30) not null,
  correo varchar(30) not null,
  observaciones varchar(200) not null,
  fecha_suscripcion date
) ENGINE=InnoDB;

create table if not exists administrador_biblioteca (
  id_bibliotecario int(10) primary key auto_increment,
  user varchar(40) not null,
  pass varchar(150) not null
) ENGINE=InnoDB;

create table if not exists visitas (
  utc int(10) primary key auto_increment not null,
  fecha_visita date not null,
  ip varchar(50) not null,
  navegador varchar(255) not null,
  pagina varchar(255) not null
) ENGINE=InnoDB;

create table if not exists prestamo_libro (
  id_prestamo int(100) primary key auto_increment not null,
  fecha_prestamo date not null,
  fecha_entrega date not null,
  id_libro int (10) not null,
  id_usuario_estudiante int (10) not null,
  foreign key (id_libro) references libros(id_libro),
  foreign key (id_usuario_estudiante) references usuario_estudiante(id_usuario_estudiante)
) ENGINE=InnoDB;

--///////  PROCEDIMIENTOS ALMACENADOS ///////

-- Categorias ///////////////////////////////////////////////////////////////////////////////////////////7777
---insertar categoria
delimiter $
CREATE PROCEDURE SP_Insertar_Categoria( 
      pdescripcion varchar(100),
    )
BEGIN   
    INSERT INTO categorias(nombre_categoria)
    VALUES(pdescripcion);
  END;
-- listar categorias
delimiter $
CREATE PROCEDURE SP_Listar_Categoria( )
BEGIN
    SELECT * FROM categorias ORDER BY nombre_categoria ASC;
  END;

--Actualizar categoria
delimiter $
CREATE PROCEDURE SP_Actualizar_categoria(id int (10), nombre varchar(100))
BEGIN
    UPDATE categorias SET
      nombre_categoria=nombre
    WHERE id_categoria = id;
END;
---Eliminar categoria
delimiter $
CREATE PROCEDURE SP_Eliminar_categoria( id int(10))
BEGIN   
    Delete from categorias where id_categoria = id;
END;
--- Buscar Categoria
delimiter $
CREATE PROCEDURE SP_Buscar_categoria(buscar varchar(50))
BEGIN 
    select * from categorias where nombre_categoria like buscar;
END;

-- Subcategorias ///////////////////////////////////////////////////////////////////////////////////////////////////7

-- Listar subcategorias
delimiter $
CREATE PROCEDURE SP_Listar_subcategoria ()
BEGIN
select * from subcategorias;
END;
--Insertar Categoria
delimiter $
CREATE PROCEDURE SP_Insertar_subategoria (IN nombre varchar(50))
BEGIN
INSERT INTO subcategorias VALUES(nombre);
END;
--Actualizar categoria
delimiter $
CREATE PROCEDURE SP_Actualizar_subcategoria(id int (10), nombre varchar(100))
BEGIN
    UPDATE subcategorias SET
      nombre_subcategoria=nombre
    WHERE id_subcategoria = id;
END;
---Eliminar subcategoria
delimiter $
CREATE PROCEDURE SP_Eliminar_subategoria( id int(10))
BEGIN   
    Delete from subcategorias where id_subcategoria = id;
END;
--- Buscar Categoria
delimiter $
CREATE PROCEDURE SP_Buscar_subcategoria(buscar varchar(50))
BEGIN 
    select * from subcategorias where nombre_subcategoria like buscar;
END;