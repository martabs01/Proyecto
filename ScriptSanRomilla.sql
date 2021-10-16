-- Base de datos BD_San Romilla
-- DROP TABLE San_Romilla;
CREATE DATABASE IF NOT EXISTS San_Romilla DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE San_Romilla;

-- Estructura tabla Colaborador
CREATE TABLE colaborador(
    correo varchar(50)  NOT NULL PRIMARY KEY,
    tipo char(1) NOT NULL default 'c',
    nombre varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono char(9) NOT NULL,
    password varchar(254) NOT NULL,
    CONSTRAINT Tipo_Usuario CHECK (tipo='a' OR tipo='c')
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Patrocinador
CREATE TABLE patrocinador(
    idPatrocinador tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(50) NOT NULL,
    telefono char(9) NOT NULL,
    logo blob NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Recorrido
CREATE TABLE recorrido(
    idRecorrido  tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    distancia smallint unsigned NOT NULL,
    imagen varchar(50) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Categoría
CREATE TABLE categoria(
    idCategoria tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categoria varchar(50) NOT NULL,
    hora_inicio_carrera time NULL,
    id_idRecorrido_Recorrido tinyint unsigned NOT NULL,
    CONSTRAINT Categoria_Recorrido FOREIGN KEY (id_idRecorrido_Recorrido) REFERENCES Recorrido(idRecorrido)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Participante
CREATE TABLE participante(
    nInscripcion  smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dni char(9) NOT NULL UNIQUE,
    fecha_nacimiento date NOT NULL,
    nombre varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    sexo char(1) NOT NULL,
    telefono char(9) NOT NULL,
    dorsal tinyint unsigned NULL UNIQUE,
    id_idCategoría_Categoria tinyint unsigned NOT NULL,
    CONSTRAINT sexo CHECK (sexo='m' OR sexo='f'),
    CONSTRAINT Categoria_Participante FOREIGN KEY ( id_idCategoría_Categoria) REFERENCES Categoria(idCategoria)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Evento
CREATE TABLE evento(
    idEvento  tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(50) NOT NULL,
    logo blob NULL,
    fecha date NULL,
    lugar varchar(50) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Clasificacion
CREATE TABLE clasificacion(
    id_nInscripcion_Participante  smallint unsigned NOT NULL PRIMARY KEY,
    id_idCategoria_Categoria tinyint unsigned NOT NULL,
    posición smallint unsigned NULL,
    tiempo time NULL,
    CONSTRAINT Clasificacion_Participante FOREIGN KEY (id_nInscripcion_Participante) REFERENCES Participante(nInscripcion),
    CONSTRAINT Categoria_Clasificacion FOREIGN KEY (id_idCategoria_Categoria) REFERENCES Categoria(idCategoria)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Imagen
CREATE TABLE imagen(
    idImagen smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    archivo varchar(100) NOT NULL,
    idEvento tinyint unsigned NOT NULL,
    CONSTRAINT Evento_Imagen FOREIGN KEY (idEvento) REFERENCES Evento(idEvento)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

