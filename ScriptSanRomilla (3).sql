-- Base de datos BD_San Romilla
-- DROP TABLE San_Romilla;
CREATE DATABASE IF NOT EXISTS San_Romilla DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE San_Romilla;

-- Estructura tabla Colaborador
CREATE TABLE colaborador(
    idColaborador tinyint unsigned  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    correo varchar(100)  NOT NULL UNIQUE,
    tipo char(1) NOT NULL DEFAULT 'c',
    nombre varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono char(9) NOT NULL,
    password varchar(254) NOT NULL,
    CONSTRAINT Tipo_Usuario CHECK (tipo='a' OR tipo='c' or tipo='i' or tipo='m')
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Recorrido
CREATE TABLE recorrido(
    idRecorrido  tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    distancia smallint unsigned NOT NULL,
    imagen varchar(50) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Categoria
CREATE TABLE categoria(
    idCategoria tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    categoria varchar(50) NOT NULL,
    h_inicio_carrera time NULL,
    ano_min year(4) NULL,
    ano_max year(4) NULL,
    precio_dorsal decimal unsigned NULL,
    id_idRecorrido_Recorrido tinyint unsigned NOT NULL,
    CONSTRAINT Categoria_Recorrido FOREIGN KEY (id_idRecorrido_Recorrido) REFERENCES recorrido(idRecorrido)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Talla
CREATE TABLE talla(
    idTallaCamiseta tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    talla_camiseta varchar(10) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Inscripcion
CREATE TABLE inscripcion(
    nInscripcion smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dni char(9) NOT NULL,
    fecha_nacimiento date NOT NULL,
    nombre varchar(50) NOT NULL,
    apellidos varchar(50) NOT NULL,
    telefono char(9) NOT NULL,
    dorsal tinyint unsigned NOT NULL UNIQUE,
    donacion_dorsal decimal unsigned NOT NULL,
    id_idTallaCamiseta_Talla tinyint unsigned NULL,
    id_idCategoria_Categoria tinyint unsigned NOT NULL,
    CONSTRAINT Categoria_Inscripcion FOREIGN KEY ( id_idCategoria_Categoria) REFERENCES categoria(idCategoria),
    CONSTRAINT TallaCamiseta_Inscripcion FOREIGN KEY ( id_idTallaCamiseta_Talla) REFERENCES talla(idTallaCamiseta) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Evento
CREATE TABLE evento(
    idEvento  tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(50) NOT NULL,
    logo blob NULL,
    fecha date NULL,
    lugar varchar(50) NULL,
    fecha_inicio_ins date NULL,
    fecha_final_ins date NULL,
    precio_camiseta decimal unsigned NULL,
    beneficio_camiseta decimal unsigned NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Fila 0
CREATE TABLE donacion(
    idDonacion smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(50) NULL,
    apellidos varchar(50) NULL,
    importe decimal unsigned NOT NULL,
    id_idTallaCamiseta_Talla tinyint unsigned NULL,
    CONSTRAINT TallaCamiseta_Donacion FOREIGN KEY ( id_idTallaCamiseta_Talla) REFERENCES talla(idTallaCamiseta) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Imagen
CREATE TABLE imagen(
    idImagen smallint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    archivo varchar(100) NOT NULL,
    idEvento tinyint unsigned NOT NULL
    CONSTRAINT Evento_Imagen FOREIGN KEY (idEvento) REFERENCES Evento(idEvento)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Patrocinador
CREATE TABLE patrocinador(
    idPatrocinador tinyint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(30) NOT NULL,
    telefono char(9) NOT NULL,
    logo blob NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Estructura tabla Clasificacion
CREATE TABLE clasificacion(
    id_nInscripcion_Inscripcion smallint unsigned NOT NULL,
    id_idCategoria_Categoria tinyint unsigned NOT NULL,
    posicion smallint unsigned NULL,
    sexo char(1) NOT NULL DEFAULT 'm',
    tiempo time NULL,
    CONSTRAINT Clasificacion_Inscripcion FOREIGN KEY (id_nInscripcion_Inscripcion) REFERENCES inscripcion            (nInscripcion),
    CONSTRAINT Categoria_Clasificacion FOREIGN KEY (id_idCategoria_Categoria) REFERENCES categoria(idCategoria),
    -- Mal 
    CONSTRAINT Clasificacion PRIMARY KEY (id_nInscripcion_Inscripcion,id_idCategoria_Categoria,posicion,sexo),
    CONSTRAINT Sexo_Participante CHECK (sexo='m' OR sexo='f'),
    CONSTRAINT Posicion_Clasificacion CHECK (posicion BETWEEN 1 and 3) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

